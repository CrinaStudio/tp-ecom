<?php

namespace Src\Shared\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use Src\Shared\Domain\IdGenerator;
use Src\Shared\Domain\PdoConnection;
use Src\Shared\Infrastructure\Lib\EloquentPdoConnection;
use Src\Shared\Infrastructure\Lib\LaravelIdGenerator;

class SharedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PdoConnection::class, EloquentPdoConnection::class);
        $this->app->singleton(IdGenerator::class, LaravelIdGenerator::class);
    }

    public function boot(): void {}
}
