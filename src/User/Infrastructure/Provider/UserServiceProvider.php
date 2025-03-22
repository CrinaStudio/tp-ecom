<?php

namespace Src\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use Src\User\Domain\Hasher;
use Src\User\Domain\Repositories\WriteUserRepository;
use Src\User\Infrastructure\Repository\EloquentWriteUserRepository;
use Src\User\Infrastructure\Service\LaravelHasher;

class UserServiceProvider extends ServiceProvider
{
    public $singletons = [
        WriteUserRepository::class => EloquentWriteUserRepository::class,
        Hasher::class => LaravelHasher::class,
    ];

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
