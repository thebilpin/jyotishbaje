FROM php:8.2-apache

# Install basic extensions
RUN docker-php-ext-install pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy app
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Configure Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader || echo "Composer failed, continuing"

# Create simple startup
RUN echo '#!/bin/bash\n\
mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache\n\
chmod -R 775 storage bootstrap/cache\n\
chown -R www-data:www-data storage bootstrap/cache\n\
apache2-foreground' > /start.sh && chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]