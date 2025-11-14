#!/usr/bin/env bash
set -e

# Set Redis URL if not provided - leave empty to use file cache
export REDIS_URL="${REDIS_URL:-}"

if [ -n "${DB_HOST}" ]; then
  echo "Waiting for database connection..."
  until php -r 'try {$host = getenv("DB_HOST") ?: "mysql"; $port = getenv("DB_PORT") ?: 3306; $fp = @fsockopen($host, (int) $port, $errno, $errstr, 2); if ($fp) {fclose($fp); exit(0);} exit(1);} catch (Throwable $e) {exit(1);}'; do
    echo "Database not ready yet, retrying in 2 seconds..."
    sleep 2
  done
  echo "Database connection successful!"
fi

echo "Running database migrations..."
php artisan migrate --force --isolated 2>/dev/null || echo "Migrations already applied"

echo "Seeding initial data..."
php artisan db:seed --class=InitialDataSeeder --force 2>/dev/null || echo "Seeder already ran"

# Create symlink for public directory to fix asset paths
if [ ! -L "public/public" ]; then
    echo "Creating symlink for public assets..."
    ln -s /app/public /app/public/public
fi

php artisan package:discover --ansi

# Clear all caches first
php artisan view:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Optimize for production
echo "Optimizing application for production..."
if [ -n "$REDIS_URL" ]; then
  echo "Using Redis for caching..."
  php artisan config:cache
  php artisan view:cache
  php artisan event:cache
else
  echo "Redis not available, using file-based caching..."
  php artisan config:cache
  php artisan view:cache
fi

# Use the PORT environment variable from Railway
PORT="${PORT:-8000}"
echo "Starting Nginx + PHP-FPM on port $PORT..."

# Substitute PORT in nginx config
envsubst '${PORT}' < nginx.conf > /tmp/nginx.conf

# Test Redis connectivity and configure accordingly
REDIS_AVAILABLE=false
if [ -n "$REDIS_URL" ]; then
  echo "Testing Redis connection..."
  if php -r "
    try {
      \$redis = new Redis();
      \$parsed = parse_url('$REDIS_URL');
      \$host = \$parsed['host'] ?? '127.0.0.1';
      \$port = \$parsed['port'] ?? 6379;
      \$redis->connect(\$host, \$port, 2);
      echo 'Redis connection successful';
      exit(0);
    } catch (Exception \$e) {
      echo 'Redis connection failed: ' . \$e->getMessage();
      exit(1);
    }
  " 2>/dev/null; then
    REDIS_AVAILABLE=true
    echo "Redis is available at $REDIS_URL"
  else
    echo "Redis connection failed, falling back to file-based storage"
  fi
fi

# Configure PHP-FPM based on Redis availability
if [ "$REDIS_AVAILABLE" = true ]; then
  echo "Configuring PHP-FPM with Redis session handler..."
  envsubst '${REDIS_URL}' < php-fpm.conf > /tmp/php-fpm.conf
  # Set environment variables for Laravel
  export CACHE_DRIVER=redis
  export SESSION_DRIVER=redis
else
  echo "Configuring PHP-FPM with file-based sessions..."
  # Remove Redis session configuration if Redis is not available
  sed '/php_value\[session.save_handler\]/d; /php_value\[session.save_path\]/d' php-fpm.conf > /tmp/php-fpm.conf
  # Set environment variables for Laravel to use file-based storage
  export CACHE_DRIVER=file
  export SESSION_DRIVER=file
fi

# Copy PHP configuration
cp php.ini /tmp/php.ini 2>/dev/null || true

# Start PHP-FPM in background with custom php.ini
php-fpm -y /tmp/php-fpm.conf -c /tmp/php.ini -F &

# Create Nginx directories
mkdir -p /tmp/nginx/{logs,client_body,proxy,fastcgi,uwsgi,scgi}
mkdir -p /var/log/nginx

# Start Nginx in foreground
exec nginx -c /tmp/nginx.conf -g "daemon off;"
