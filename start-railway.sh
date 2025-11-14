#!/usr/bin/env bash
set -e

echo "=== Railway Laravel Startup ==="

# Set production environment variables
export APP_ENV=production
export APP_DEBUG=false
export LOG_CHANNEL=stderr
export LOG_LEVEL=info

# Configure cache and session for Railway
if [ -z "$REDIS_URL" ]; then
    echo "No Redis URL found, using file-based cache/sessions"
    export CACHE_DRIVER=file
    export SESSION_DRIVER=file
else
    echo "Redis URL found, using Redis for cache/sessions"
    export CACHE_DRIVER=redis
    export SESSION_DRIVER=redis
fi

# Create required directories with proper permissions
mkdir -p storage/{framework/{sessions,views,cache},logs,app/public}
mkdir -p bootstrap/cache
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Clear any cached config that might interfere
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Wait for database to be ready (Railway MySQL)
if [ -n "$DATABASE_URL" ] || [ -n "$DB_HOST" ]; then
    echo "Waiting for database to be ready..."
    
    # Extract database info from DATABASE_URL if present
    if [ -n "$DATABASE_URL" ]; then
        # Parse DATABASE_URL: mysql://user:pass@host:port/dbname
        DB_INFO=$(echo $DATABASE_URL | sed 's/mysql:\/\///')
        export DB_HOST=$(echo $DB_INFO | cut -d'@' -f2 | cut -d':' -f1)
        export DB_PORT=$(echo $DB_INFO | cut -d'@' -f2 | cut -d':' -f2 | cut -d'/' -f1)
        export DB_DATABASE=$(echo $DB_INFO | cut -d'/' -f2)
        export DB_USERNAME=$(echo $DB_INFO | cut -d'@' -f1 | cut -d':' -f1)
        export DB_PASSWORD=$(echo $DB_INFO | cut -d'@' -f1 | cut -d':' -f2)
    fi
    
    # Wait up to 30 seconds for database
    for i in {1..30}; do
        if php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null; then
            echo "Database connection successful!"
            break
        fi
        echo "Waiting for database... attempt $i/30"
        sleep 2
        
        if [ $i -eq 30 ]; then
            echo "Warning: Could not connect to database after 60 seconds"
        fi
    done
    
    # Run migrations with proper error handling
    echo "Running database migrations..."
    if php artisan migrate --force --no-interaction; then
        echo "Migrations completed successfully"
    else
        echo "Migration failed, trying to create admin user manually..."
        php artisan tinker --execute="
            try {
                if (!DB::table('admin')->where('email', 'admin@admin.com')->exists()) {
                    DB::table('admin')->insert([
                        'name' => 'Admin',
                        'email' => 'admin@admin.com', 
                        'password' => Hash::make('admin123'),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                echo 'Admin user created';
            } catch (Exception \$e) {
                echo 'Failed to create admin: ' . \$e->getMessage();
            }
        " || echo "Manual admin creation failed"
    fi
    
    # Ensure admin user exists
    echo "Ensuring admin user exists..."
    php artisan db:seed --class=AdminUserSeeder --force --no-interaction || {
        echo "Admin seeder failed, but continuing startup..."
    }
    
    # Seed initial data if needed
    if php artisan tinker --execute="echo DB::table('users')->count();" 2>/dev/null | grep -q "^0$"; then
        echo "Database appears empty, running seeders..."
        php artisan db:seed --force --no-interaction || {
            echo "Seeding failed, but continuing startup..."
        }
    fi
else
    echo "No database configuration found, skipping database setup"
fi

# Create storage link for file uploads
php artisan storage:link 2>/dev/null || echo "Storage link already exists or failed"

# Ensure Vite assets exist for admin dashboard
echo "Ensuring frontend assets are available..."
mkdir -p public/build/assets
if [ ! -f public/build/manifest.json ]; then
    echo "Creating fallback Vite manifest..."
    echo '{"resources/css/app.css":{"file":"assets/app.css","src":"resources/css/app.css"},"resources/js/app.js":{"file":"assets/app.js","src":"resources/js/app.js"}}' > public/build/manifest.json
fi

# Create fallback CSS and JS files if they don't exist
if [ ! -f public/build/assets/app.css ]; then
    echo "/* Fallback CSS */ body { font-family: system-ui; } .login { background: #667eea; min-height: 100vh; }" > public/build/assets/app.css
fi

if [ ! -f public/build/assets/app.js ]; then
    echo "/* Fallback JS */ console.log('Assets loaded');" > public/build/assets/app.js
fi

# Optimize for production
echo "Optimizing Laravel for production..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Configure PHP settings for Railway
echo "Configuring PHP settings for Railway environment..."
export PHP_INI_SCAN_DIR="/app/php"
mkdir -p /app/php
cat > /app/php/railway.ini << 'EOF'
max_execution_time=300
max_input_time=60
memory_limit=512M
default_socket_timeout=30
mysql.connect_timeout=10
allow_url_fopen=1
allow_url_include=0
max_file_uploads=20
upload_max_filesize=50M
post_max_size=50M
EOF

# Set PORT from Railway
PORT="${PORT:-8000}"

echo "=== Starting Laravel Application on Port $PORT ==="
echo "Environment: $APP_ENV"
echo "Debug: $APP_DEBUG"
echo "Cache Driver: ${CACHE_DRIVER:-file}"
echo "Session Driver: ${SESSION_DRIVER:-file}"
echo "Memory Limit: $(php -r 'echo ini_get("memory_limit");')"
echo "Max Execution Time: $(php -r 'echo ini_get("max_execution_time");')"

# Start Laravel with proper host binding for Railway
exec php -d max_execution_time=300 -d memory_limit=512M artisan serve --host=0.0.0.0 --port=$PORT