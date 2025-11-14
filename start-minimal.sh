#!/usr/bin/env bash
set -e

echo "=== Minimal Laravel Startup ==="

# Set environment
export APP_ENV=production
export CACHE_DRIVER=file
export SESSION_DRIVER=file

# Create directories
mkdir -p storage/{framework/{sessions,views,cache},logs}
mkdir -p bootstrap/cache
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

# Basic Laravel setup
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Use Laravel's built-in server as fallback
PORT="${PORT:-8000}"
echo "Starting Laravel development server on port $PORT"
exec php artisan serve --host=0.0.0.0 --port=$PORT