FROM php:8.2-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    zip unzip git libicu-dev libxml2-dev libzip-dev libonig-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Enable Apache Rewrite
RUN a2enmod rewrite

# Apache configuration
COPY ./apache/default.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Symfony app
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Ensure permissions for mounted volumes in dev/prod
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor
