#!/usr/bin/env bash
set -e

echo "=== Laravel Application Startup ==="

# Basic environment setup
export CACHE_DRIVER=file
export SESSION_DRIVER=file
export QUEUE_CONNECTION=sync

# Set port
PORT="${PORT:-8000}"
echo "Using port: $PORT"

# Wait for database if configured
if [ -n "${DB_HOST}" ]; then
  echo "Waiting for database..."
  until php -r 'try {$pdo = new PDO("mysql:host=".getenv("DB_HOST").";port=".(getenv("DB_PORT")?:3306), getenv("DB_USERNAME"), getenv("DB_PASSWORD")); exit(0);} catch(Exception $e) {exit(1);}' 2>/dev/null; do
    echo "Database not ready, retrying..."
    sleep 2
  done
  echo "Database connected!"
fi

# Create required directories
echo "Setting up directories..."
mkdir -p storage/framework/{sessions,views,cache,testing}
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Run migrations and seeding
echo "Running database setup..."
php artisan migrate --force 2>/dev/null || echo "Migration skipped"
php artisan db:seed --class=InitialDataSeeder --force 2>/dev/null || echo "Seeding skipped"

# Clear and cache config
echo "Optimizing application..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache

# Simple PHP-FPM configuration
echo "Configuring PHP-FPM..."
cat > /tmp/php-fpm.conf << 'EOF'
[global]
error_log = /dev/stderr
daemonize = no

[www]
user = nobody
group = nobody
listen = 127.0.0.1:9000
pm = dynamic
pm.max_children = 20
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 3
clear_env = no
catch_workers_output = yes
EOF

# Simple Nginx configuration
echo "Configuring Nginx..."
cat > /tmp/nginx.conf << EOF
worker_processes 1;
error_log /dev/stderr warn;
pid /tmp/nginx.pid;

events {
    worker_connections 1024;
}

http {
    include       /etc/nginx/mime.types;
    default_type  application/octet-stream;
    
    access_log /dev/stdout;
    sendfile on;
    keepalive_timeout 65;
    
    client_body_temp_path /tmp/client_body;
    proxy_temp_path /tmp/proxy;
    fastcgi_temp_path /tmp/fastcgi;
    
    server {
        listen $PORT;
        root /app/public;
        index index.php;
        
        location / {
            try_files \$uri \$uri/ /index.php?\$query_string;
        }
        
        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
            include /etc/nginx/fastcgi_params;
        }
    }
}
EOF

# Create temp directories
mkdir -p /tmp/{client_body,proxy,fastcgi}

# Start PHP-FPM
echo "Starting PHP-FPM..."
php-fpm -y /tmp/php-fpm.conf -F &

# Wait a moment
sleep 2

# Start Nginx
echo "Starting Nginx..."
exec nginx -c /tmp/nginx.conf -g "daemon off;"