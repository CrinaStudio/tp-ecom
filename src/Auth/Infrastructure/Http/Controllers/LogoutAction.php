<?php

namespace Src\Auth\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public function __invoke(): JsonResponse
    {
        Auth::guard('web')->logout();

        return response()->json([
            'isLoggedOut' => true,
            'message' => 'Logout success',
        ]);
    }
}
