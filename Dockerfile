FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Copy only composer files first (better caching)
COPY composer.json /var/www/html/

# Install dependencies
RUN composer install
RUN composer dump-autoload

# Copy application code
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html