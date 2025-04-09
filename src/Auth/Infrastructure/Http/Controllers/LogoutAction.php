<?php

namespace Src\Auth\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public function __invoke(): JsonResponse
    {

        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'isLoggedOut' => true,
            'message' => 'Logout success',
        ]);
    }
}
