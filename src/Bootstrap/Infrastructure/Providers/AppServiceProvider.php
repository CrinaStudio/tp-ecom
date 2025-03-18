<?php

namespace Src\Bootstrap\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Shared\Infrastructure\Provider\SharedServiceProvider;
use Src\User\Infrastructure\Provider\UserServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(SharedServiceProvider::class);
        $this->app->register(UserServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
