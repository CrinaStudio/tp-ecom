<?php

namespace Src\Auth\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\User\Infrastructure\Models\User;

class LoginAction
{
    public function __invoke(
        Request $request,
    ): JsonResponse {
        $email = $request->get('email');
        $password = $request->get('password');

        $httpJson = [
            'isLoggedIn' => false,
            'token' => null,
        ];
        if (! Auth::attempt(['email' => $email, 'password' => $password])) {
            $httpJson['message'] = 'Invalid email or password';

            return response()->json($httpJson, 401);
        }

        $user = User::query()->where('email', $email)->firstOrFail();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'isLoggedIn' => true,
            'token' => $token,
        ]);
    }
}
