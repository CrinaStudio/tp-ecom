#!/bin/bash
set -e

# Attendre que la base de données soit prête (si vous utilisez Docker Compose)
if [ ! -z "$DB_HOST" ]; then
    echo "Attente de la disponibilité de la base de données..."
    until mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1"; do
        echo "Base de données indisponible - attente..."
        sleep 2
    done
    echo "Base de données disponible!"
fi

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

# Exécuter les seeds
echo "Exécution des seeds..."
php artisan db:seed --force

# Optimiser l'application pour la production
if [ "$APP_ENV" = "production" ]; then
    echo "Optimisation de l'application pour la production..."
    php artisan optimize
fi

# Exécuter la commande spécifiée
exec "$@"
