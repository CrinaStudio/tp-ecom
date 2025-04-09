<?php

use Illuminate\Support\Facades\Route;
use Src\Auth\Infrastructure\Http\Controllers\LoginAction;
use Src\Auth\Infrastructure\Http\Controllers\LogoutAction;

Route::post('/login', LoginAction::class);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', LogoutAction::class)->name('logout');
});
