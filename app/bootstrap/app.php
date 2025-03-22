<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Src\Bootstrap\Infrastructure\Providers\AppServiceProvider;

$app = Application::configure(basePath: dirname(__DIR__, 2))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withProviders([
        AppServiceProvider::class,
    ])
    ->create();

$app->useAppPath(base_path() . '/src');
$app->useBootstrapPath(base_path() . '/app/bootstrap');
$app->useConfigPath(base_path() . '/app/config');
$app->usePublicPath(base_path() . '/app/public');
$app->useStoragePath(base_path() . '/app/storage');
$app->useDatabasePath(base_path() . '/src/Bootstrap/Infrastructure/database');
return $app;

