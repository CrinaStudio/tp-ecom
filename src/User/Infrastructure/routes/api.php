<?php

use Illuminate\Support\Facades\Route;
use Src\User\Infrastructure\Http\Controllers\RegisterUserAction;

Route::post('/register', RegisterUserAction::class);
