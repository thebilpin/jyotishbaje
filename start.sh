#!/usr/bin/env bash
set -e

if [ -n "${DB_HOST}" ]; then
  echo "Waiting for database at ${DB_HOST}:${DB_PORT:-3306}..."
  until php -r 'try {$host = getenv("DB_HOST") ?: "mysql"; $port = getenv("DB_PORT") ?: 3306; $fp = @fsockopen($host, (int) $port, $errno, $errstr, 2); if ($fp) {fclose($fp); exit(0);} exit(1);} catch (Throwable $e) {exit(1);}'; do
    sleep 2
  done
fi

echo "Running database migrations..."
php artisan migrate --force

echo "Importing initial data if needed..."
if [ -f "astromigratedb.sql" ]; then
  mysql -h "${DB_HOST}" -P "${DB_PORT:-3306}" -u "${DB_USERNAME}" -p"${DB_PASSWORD}" "${DB_DATABASE}" < astromigratedb.sql || echo "SQL import failed or already imported, continuing..."
fi

php artisan package:discover --ansi
php artisan config:cache
php artisan route:cache || echo "Skipping route:cache; continuing without cached routes."
php artisan view:cache
php artisan event:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
