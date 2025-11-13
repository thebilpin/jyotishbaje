#!/usr/bin/env bash
set -e

if [ -n "${DB_HOST}" ]; then
  echo "Waiting for database at ${DB_HOST}:${DB_PORT:-3306}..."
  until php -r 'try {$host = getenv("DB_HOST") ?: "mysql"; $port = getenv("DB_PORT") ?: 3306; $fp = @fsockopen($host, (int) $port, $errno, $errstr, 2); if ($fp) {fclose($fp); exit(0);} exit(1);} catch (Throwable $e) {exit(1);}'; do
    sleep 2
  done
fi

php artisan package:discover --ansi
php artisan config:cache
php artisan route:cache || echo "Skipping route:cache; continuing without cached routes."
php artisan view:cache
php artisan event:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
