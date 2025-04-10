<?php

namespace Src\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use Src\User\Domain\Repository\AuthRepositoryInterface;
use Src\User\Domain\Repository\UserRepositoryInterface;
use Src\User\Infrastructure\Repository\EloquentAuthRepository;
use Src\User\Infrastructure\Repository\EloquentUserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrations();
        $this->registerRoutes();
        $this->app->singleton(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->singleton(AuthRepositoryInterface::class, EloquentAuthRepository::class);
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
