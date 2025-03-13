# Utiliser l'image officielle PHP avec les extensions nécessaires
FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www

# S'assurer que les dossiers `storage` et `bootstrap/cache` existent
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Donner les permissions correctes à l'utilisateur `www-data`
RUN chown -R www-data:www-data /var/www

# Utiliser l'utilisateur `www-data` par défaut
USER www-data

# Exposer le port
EXPOSE 9000

CMD ["php-fpm"]
