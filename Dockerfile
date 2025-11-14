FROM webdevops/php-apache:8.2

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction || echo "Composer install failed, continuing..."

# Create required directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache public/build/assets \
    && chmod -R 775 storage bootstrap/cache public/build \
    && chown -R application:application storage bootstrap/cache public/build

# Create Vite manifest and fallback assets
RUN echo '{"resources/css/app.css":{"file":"assets/app.css","src":"resources/css/app.css"},"resources/js/app.js":{"file":"assets/app.js","src":"resources/js/app.js"}}' > public/build/manifest.json \
    && echo "body { font-family: system-ui; }" > public/build/assets/app.css \
    && echo "console.log('Assets loaded');" > public/build/assets/app.js

# Set Apache DocumentRoot to Laravel public directory
ENV WEB_DOCUMENT_ROOT=/app/public

# Create startup script
RUN echo '#!/bin/bash\ncd /app\nmkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache\nchmod -R 775 storage bootstrap/cache\nchown -R application:application storage bootstrap/cache\nphp artisan config:cache || true\nphp artisan route:cache || true\nphp artisan view:cache || true\nphp artisan migrate --force || true\nphp artisan db:seed --class=AdminUserSeeder --force || true\nexec supervisord' > /start.sh \
    && chmod +x /start.sh

# Expose port 80
EXPOSE 80

# Start services
CMD ["/start.sh"]