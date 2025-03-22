<?php

namespace Src\User\Infrastructure\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Src\Shared\Infrastructure\Http\Response\ApiErrorResponse;
use Src\Shared\Infrastructure\Http\Response\ApiSuccessResponse;
use Src\User\Application\Query\Profile\GetUserProfileQueryHandler;
use Throwable;

class GetUserProfileAction
{
    public function __invoke(
        string $userId,
        GetUserProfileQueryHandler $queryHandler
    ): Responsable {

        try {
            $response = $queryHandler->handle($userId);

            return new ApiSuccessResponse(
                data: $response->profile
            );
        } catch (Throwable $e) {
            return new ApiErrorResponse(
                message: $e->getMessage(),
                exception: $e
            );
        }
    }
}
