FROM php:8.2-apache

# Installer les packages nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libicu-dev libxml2-dev libzip-dev libonig-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Activer Apache Rewrite
RUN a2enmod rewrite

# Copier config Apache
COPY ./apache/default.conf /etc/apache2/sites-available/000-default.conf

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier l’application
COPY . /var/www/html

# Installer uniquement les dépendances de prod
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Assurer les permissions
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor

# Exposer le port HTTP
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
