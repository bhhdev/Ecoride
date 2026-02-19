# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer les packages nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libicu-dev libxml2-dev libzip-dev libonig-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Copier la configuration Apache
COPY ./apache/default.conf /etc/apache2/sites-available/000-default.conf

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le code Symfony
COPY . /var/www/html

# Installer les dépendances Composer pour la prod
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Compiler les assets en production
RUN php bin/console asset-map:compile --env=prod

# S’assurer que les permissions sont correctes
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor /var/www/html/public/assets

# Exposer le port Apache
EXPOSE 80
