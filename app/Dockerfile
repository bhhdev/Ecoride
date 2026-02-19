# Utiliser PHP Apache 8.2
FROM php:8.2-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    zip unzip git libicu-dev libxml2-dev libzip-dev libonig-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Activer mod_rewrite Apache
RUN a2enmod rewrite

# Copier la conf Apache
COPY ./apache/default.conf /etc/apache2/sites-available/000-default.conf

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier l’application Symfony
COPY . /var/www/html

# Installer uniquement les dépendances prod
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Compiler les assets en prod (optionnel si tu veux compiler à l’intérieur du conteneur)
# RUN php bin/console asset-map:compile --env=prod

# Droits pour Apache
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor

# Exposer le port 80
EXPOSE 80
