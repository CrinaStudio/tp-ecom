<?php

use Illuminate\Support\Facades\Route;
use Src\User\Infrastructure\Http\Controllers\GetUserProfileAction;

Route::get('/users/{id}', GetUserProfileAction::class);
