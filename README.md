# Laravel 11 API REST Boilerplate

Ce projet est un boilerplate pour le développement d'API REST avec Laravel 11, suivant les principes d'architecture hexagonale, de TDD et de bonnes pratiques de développement.

## Technologies et concepts implémentés

- **Laravel 11** : Framework PHP moderne
- **PHP 8.2+** : Utilisation des dernières fonctionnalités de PHP
- **Docker** : Conteneurisation pour le développement et la production
- **MySQL** : Base de données relationnelle
- **Architecture Hexagonale** : Séparation claire entre domaine, application et infrastructure
- **Screaming Architecture** : Structure de projet révélant l'intention du code
- **CQS (Command Query Separation)** : Séparation des opérations de lecture et d'écriture
- **TDD (Test-Driven Development)** : Développement guidé par les tests
- **TestContainers** : Conteneurs Docker pour les tests d'intégration
- **Clean Code** : Principes de code propre et lisible
- **Monitoring** : Prometheus et Grafana pour la supervision
- **Logging** : Gestion centralisée des logs

## Prérequis

- Docker et Docker Compose
- PHP 8.2 ou supérieur (pour le développement local)
- Composer (pour le développement local)

## Installation

### Installation automatique

Pour installer automatiquement le projet, exécutez le script d'initialisation :

```bash
./init-project.sh
```

### Installation manuelle

1. Clonez le dépôt :
```bash
git clone <url-du-depot> laravel-api-boilerplate
cd laravel-api-boilerplate
```

2. Copiez le fichier d'environnement :
```bash
cp .env.example .env
```

3. Lancez les conteneurs Docker :
```bash
docker-compose up -d
```

4. Installez les dépendances PHP :
```bash
docker-compose exec app composer install
```

5. Générez la clé d'application :
```bash
docker-compose exec app php artisan key:generate
```

6. Exécutez les migrations :
```bash
docker-compose exec app php artisan migrate
```

## Structure du projet

Le projet suit une architecture hexagonale (ou ports et adaptateurs) avec une séparation claire entre les différentes couches :

- **Domain** : Contient les entités, les value objects, les interfaces de repository et les règles métier
- **Application** : Contient les use cases (commands/queries) et les services d'application
- **Infrastructure** : Contient les implémentations concrètes (repositories, controllers, etc.)

```
app/
├── Application/       # Use cases et services d'application
│   ├── Commands/      # Commands (CQS)
│   ├── Queries/       # Queries (CQS)
│   ├── EventHandlers/ # Gestionnaires d'événements
│   └── Services/      # Services d'application
├── Domain/            # Cœur métier
│   ├── Entities/      # Entités métier
│   ├── Events/        # Événements métier
│   ├── Exceptions/    # Exceptions métier
│   ├── Repositories/  # Interfaces de repositories
│   ├── Services/      # Interfaces de services métier
│   └── ValueObjects/  # Value Objects
└── Infrastructure/    # Implémentations techniques
    ├── Database/      # Base de données
    ├── Http/          # Controllers et routes
    ├── Logging/       # Gestion des logs
    └── Monitoring/    # Services de monitoring
```

## Tests

Pour exécuter les tests, utilisez la commande :

```bash
./run-tests.sh
```

Ce script va :
1. Configurer l'environnement de test
2. Nettoyer et migrer la base de données de test
3. Exécuter les tests unitaires, fonctionnels et d'intégration

## Monitoring

Le projet inclut Prometheus et Grafana pour le monitoring. Vous pouvez accéder aux interfaces :

- Prometheus : http://localhost:9090
- Grafana : http://localhost:3000

## Contribution

Pour contribuer au projet, veuillez suivre ces étapes :

1. Créez une br
