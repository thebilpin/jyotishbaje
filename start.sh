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
php artisan migrate --force

echo "Seeding initial data..."
php artisan db:seed --class=InitialDataSeeder --force || echo "Seeder already ran or failed, continuing..."

php artisan package:discover --ansi
php artisan config:cache
php artisan route:cache || echo "Skipping route:cache; continuing without cached routes."
php artisan view:cache
php artisan event:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
