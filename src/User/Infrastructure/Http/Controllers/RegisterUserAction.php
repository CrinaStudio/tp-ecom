<?php

namespace Src\User\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\User\Application\Command\Register\RegisterUserHandler;
use Src\User\Infrastructure\Factory\RegisterUserCommandFactory;

class RegisterUserAction
{
    public function __invoke(
        Request $request,
        RegisterUserHandler $handler,
    ): JsonResponse {

        $command = RegisterUserCommandFactory::fromRequest($request);

        $response = $handler->handle($command);

        return response()->json([
            'id' => $response->userId,
            'isCreated' => $response->isCreated,
        ], 201);
    }
}
