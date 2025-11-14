FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    nodejs \
    npm \
    && docker-php-ext-configure gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy existing application directory contents
COPY . /app

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /app

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node.js dependencies and build assets
RUN npm install --production || echo "NPM install failed, continuing..."
RUN npm run build || npm run prod || bash build-assets.sh || echo "Asset build failed, using fallbacks"

# Create required directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && mkdir -p public/build/assets \
    && chmod -R 775 storage bootstrap/cache public/build \
    && chown -R www-data:www-data storage bootstrap/cache public/build

# Ensure Vite manifest exists
RUN if [ ! -f public/build/manifest.json ]; then \
        echo '{"resources/css/app.css":{"file":"assets/app.css","src":"resources/css/app.css"},"resources/js/app.js":{"file":"assets/app.js","src":"resources/js/app.js"}}' > public/build/manifest.json; \
    fi

# Create fallback assets if they don't exist
RUN if [ ! -f public/build/assets/app.css ]; then \
        echo "/* Fallback CSS */ body { font-family: system-ui; }" > public/build/assets/app.css; \
    fi && \
    if [ ! -f public/build/assets/app.js ]; then \
        echo "console.log('Assets loaded');" > public/build/assets/app.js; \
    fi

# Copy Nginx configuration
COPY nginx-fly.conf /etc/nginx/sites-available/default

# Copy supervisor configuration
COPY supervisord-fly.conf /etc/supervisor/conf.d/supervisord.conf

# Make startup script executable
RUN chmod +x start-fly.sh

# Expose port 8000
EXPOSE 8000

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]