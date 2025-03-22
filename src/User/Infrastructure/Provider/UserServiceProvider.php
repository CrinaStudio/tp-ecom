<?php

namespace Src\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrations();
        $this->loadRoutes();
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function boot(): void {}

    private function loadRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
