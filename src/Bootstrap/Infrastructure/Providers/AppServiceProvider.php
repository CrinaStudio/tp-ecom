<?php

namespace Src\Bootstrap\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Auth\Infrastructure\Provider\AuthServiceProvider;
use Src\User\Infrastructure\Provider\UserServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
