<?php

namespace Src\User\Infrastructure\Http\Requests;

use Src\Shared\Infrastructure\Http\Request\HttpDataRequest;

class CreateUserRequest extends HttpDataRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ];
    }
}
