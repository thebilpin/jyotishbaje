#!/usr/bin/env bash
set -e

# Set Redis URL if not provided (Railway auto-provides this)
export REDIS_URL="${REDIS_URL:-redis://localhost:6379}"

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

# Optimize for production with Redis cache
echo "Optimizing application for production..."
php artisan config:cache
php artisan view:cache
php artisan event:cache

# Use the PORT environment variable from Railway
PORT="${PORT:-8000}"
echo "Starting Nginx + PHP-FPM on port $PORT..."

# Substitute PORT in nginx config
envsubst '${PORT}' < nginx.conf > /tmp/nginx.conf
envsubst '${REDIS_URL}' < php-fpm.conf > /tmp/php-fpm.conf

# Copy PHP configuration
cp php.ini /tmp/php.ini 2>/dev/null || true

# Start PHP-FPM in background with custom php.ini
php-fpm82 -y /tmp/php-fpm.conf -c /tmp/php.ini -F &

# Start Nginx in foreground
exec nginx -c /tmp/nginx.conf -g "daemon off;"
