<?php

use Illuminate\Support\Facades\Route;
use Src\User\Infrastructure\Http\Controllers\CreateUserAction;
use Src\User\Infrastructure\Http\Controllers\GetUserProfileAction;

Route::prefix('api')->group(function () {
    Route::post('/users', CreateUserAction::class);
    Route::get('/users/{id}', GetUserProfileAction::class);
});
