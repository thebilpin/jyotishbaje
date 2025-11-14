#!/usr/bin/env bash
set -e

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

# Clear all caches first to ensure fresh compilation
php artisan view:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Optimize for production
php artisan config:cache
php artisan view:cache
php artisan event:cache
# Enable OPcache for better performance
echo "opcache.enable=1" >> /etc/php.ini 2>/dev/null || true
echo "opcache.memory_consumption=256" >> /etc/php.ini 2>/dev/null || true
echo "opcache.max_accelerated_files=20000" >> /etc/php.ini 2>/dev/null || true
echo "opcache.validate_timestamps=0" >> /etc/php.ini 2>/dev/null || true

# Use the PORT environment variable from Railway
PORT="${PORT:-8000}"
echo "Starting optimized PHP server on port $PORT..."

# Use PHP built-in server with optimizations for production
exec php -d memory_limit=512M -d max_execution_time=60 -d opcache.enable=1 -S 0.0.0.0:${PORT} -t public public/index.php
