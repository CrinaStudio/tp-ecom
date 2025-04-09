<?php

namespace Src\User\Infrastructure\Factory;

use Illuminate\Http\Request;
use Src\User\Application\Command\Register\RegisterUserCommand;

class RegisterUserCommandFactory
{
    public static function fromRequest(Request $request): RegisterUserCommand
    {
        return new RegisterUserCommand(
            name: $request->get('name'),
            email: $request->get('email'),
            password: $request->get('password'),
            passwordConfirmation: $request->get('password_confirmation'),
            role: $request->get('role')
        );
    }
}
