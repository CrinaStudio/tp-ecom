# Utiliser l'image officielle PHP avec les extensions nécessaires
FROM php:8.2-fpm

# Installer Node.js et npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www

# Copier .env.example en .env si .env n'existe pas
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Installer les dépendances PHP
RUN composer install  --optimize-autoloader

# Installer les dépendances JS
RUN npm install && npm run build

# Générer la clé d'application
RUN php artisan key:generate --force

# S'assurer que les dossiers `storage` et `bootstrap/cache` existent
RUN mkdir -p /var/www/app/storage /var/www/app/bootstrap/cache \
    && chown -R www-data:www-data /var/www/app/storage /var/www/app/bootstrap/cache


# Script pour exécuter les migrations et seeds au démarrage
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Donner les permissions correctes à l'utilisateur `www-data`
RUN chmod -R 775 app/storage app/bootstrap/cache \
        && chown -R www-data:www-data /var/www

# Utiliser l'utilisateur `www-data` par défaut
USER www-data

# Exposer le port
EXPOSE 9000

CMD ["php-fpm"]
