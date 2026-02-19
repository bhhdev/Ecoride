# Étape 0 : image de base PHP Apache
FROM php:8.2-apache AS prod

# Installer les paquets nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libicu-dev libxml2-dev libzip-dev libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# Activer mod_rewrite pour Symfony
RUN a2enmod rewrite

# Copier la conf Apache
COPY ./apache/default.conf /etc/apache2/sites-available/000-default.conf

# Installer Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Travailler dans le dossier de Symfony
WORKDIR /var/www/html

# Copier tout le projet
COPY . /var/www/html

# Autoriser symfony/flex pour composer
RUN composer config --no-plugins allow-plugins.symfony/flex true

# Installer uniquement les dépendances prod
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Assurer les permissions pour Apache
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public/assets

# Exposer le port HTTP
EXPOSE 80

# Lancer Apache en foreground
CMD ["apache2-foreground"]
