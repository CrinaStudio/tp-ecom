<?php

namespace Src\User\Infrastructure\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Src\Shared\Domain\Exceptions\ApiErrorException;
use Src\Shared\Infrastructure\Factory\DecorateHandlerFactory;
use Src\Shared\Infrastructure\Http\Response\ApiErrorResponse;
use Src\Shared\Infrastructure\Http\Response\ApiSuccessResponse;
use Src\User\Application\Command\Create\CreateUserHandler;
use Src\User\Infrastructure\Factory\CreateUserCommandFactory;
use Src\User\Infrastructure\Http\Requests\CreateUserRequest;
use Throwable;

class CreateUserAction
{
    public function __invoke(
        CreateUserRequest $request,
        CreateUserHandler $handler,
        DecorateHandlerFactory $transactionalHandlerFactory
    ): Responsable {
        try {
            $transactionalHandler = $transactionalHandlerFactory->decorate($handler);
            $command = CreateUserCommandFactory::fromRequest($request);

            $response = $transactionalHandler->handle($command);

            return new ApiSuccessResponse(
                data: [
                    $response->userId,
                    $response->isSaved,
                    $response->message,
                ],
                code: $response->code
            );
        } catch (Throwable $e) {
            if ($e instanceof ApiErrorException) {
                return new ApiErrorResponse(
                    message: $e->getMessage(),
                    exception: $e,
                    code: $e->getCode()
                );
            }

            return new ApiErrorResponse(
                message: $e->getMessage(),
                exception: $e
            );
        }

    }
}
