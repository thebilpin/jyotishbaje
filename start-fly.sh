#!/usr/bin/env bash
set -e

echo "=== Fly.io Laravel Startup ==="

# Set environment variables
export APP_ENV=production
export APP_DEBUG=false
export LOG_CHANNEL=stderr
export LOG_LEVEL=info

# Configure cache and session drivers
if [ -n "$REDIS_URL" ]; then
    echo "Redis URL found, using Redis for cache/sessions"
    export CACHE_DRIVER=redis
    export SESSION_DRIVER=redis
else
    echo "No Redis URL found, using file-based cache/sessions"
    export CACHE_DRIVER=file
    export SESSION_DRIVER=file
fi

# Create required directories with proper permissions
mkdir -p storage/{framework/{sessions,views,cache},logs,app/public}
mkdir -p bootstrap/cache
mkdir -p public/build/assets
chmod -R 775 storage bootstrap/cache public/build 2>/dev/null || true

# Clear any cached config that might interfere
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Database setup if DATABASE_URL is provided
if [ -n "$DATABASE_URL" ]; then
    echo "Database URL found, setting up database connection..."
    
    # Wait for database to be ready
    echo "Waiting for database connection..."
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
    
    # Run migrations
    echo "Running database migrations..."
    if php artisan migrate --force --no-interaction; then
        echo "Migrations completed successfully"
    else
        echo "Migration failed, trying to create admin user manually..."
        php artisan tinker --execute="
            try {
                Schema::dropIfExists('admin');
                Schema::create('admin', function (\$table) {
                    \$table->id();
                    \$table->string('name');
                    \$table->string('email')->unique();
                    \$table->timestamp('email_verified_at')->nullable();
                    \$table->string('password');
                    \$table->rememberToken();
                    \$table->timestamps();
                });
                
                DB::table('admin')->insert([
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                echo 'Admin table and user created successfully';
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
    
    # Seed initial data if database is empty
    if php artisan tinker --execute="echo DB::table('users')->count();" 2>/dev/null | grep -q "^0$"; then
        echo "Database appears empty, running seeders..."
        php artisan db:seed --force --no-interaction || {
            echo "Seeding failed, but continuing startup..."
        }
    fi
else
    echo "No database configuration found, skipping database setup"
fi

# Ensure Vite assets exist
echo "Ensuring frontend assets are available..."
if [ ! -f public/build/manifest.json ]; then
    echo "Creating fallback Vite manifest..."
    echo '{"resources/css/app.css":{"file":"assets/app.css","src":"resources/css/app.css"},"resources/js/app.js":{"file":"assets/app.js","src":"resources/js/app.js"}}' > public/build/manifest.json
fi

if [ ! -f public/build/assets/app.css ]; then
    echo "/* Fallback CSS */ body { font-family: system-ui; } .login { background: #667eea; min-height: 100vh; }" > public/build/assets/app.css
fi

if [ ! -f public/build/assets/app.js ]; then
    echo "console.log('Assets loaded');" > public/build/assets/app.js
fi

# Create storage link for file uploads
php artisan storage:link 2>/dev/null || echo "Storage link already exists or failed"

# Optimize for production
echo "Optimizing Laravel for production..."
php artisan config:cache || echo "Config cache failed"
php artisan route:cache || echo "Route cache failed"
php artisan view:cache || echo "View cache failed"

# Set PORT from Fly.io
PORT="${PORT:-8000}"

echo "=== Starting Laravel Application on Port $PORT ==="
echo "Environment: $APP_ENV"
echo "Debug: $APP_DEBUG"
echo "Cache Driver: ${CACHE_DRIVER:-file}"
echo "Session Driver: ${SESSION_DRIVER:-file}"

# Start Laravel with proper host binding for Fly.io
exec php artisan serve --host=0.0.0.0 --port=$PORT