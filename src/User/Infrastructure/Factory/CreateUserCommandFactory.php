<?php

namespace Src\User\Infrastructure\Factory;

use Src\User\Application\Command\Create\CreateUserCommand;
use Src\User\Infrastructure\Http\Requests\CreateUserRequest;

class CreateUserCommandFactory
{
    public static function fromRequest(CreateUserRequest $request): CreateUserCommand
    {
        return new CreateUserCommand(
            name: $request->get('name'),
            email: $request->get('email'),
            password: $request->get('password'),
        );

    }
}
