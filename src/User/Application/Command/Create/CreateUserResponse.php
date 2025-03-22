<?php

namespace Src\User\Application\Command\Create;

class CreateUserResponse
{
    public bool $isSaved = false;

    public string $userId = '';

    public int $code = 500;

    public string $message = '';
}
