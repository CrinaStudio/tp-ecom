<?php

namespace Src\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Infrastructure\Repository\EloquentUserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrations();
        $this->registerRoutes();
        $this->app->singleton(UserRepository::class, EloquentUserRepository::class);
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    private function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }

    public function boot(): void {}
}
