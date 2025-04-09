<?php

namespace Src\User\Application\Command\Register;

class RegisterUserResponse
{
    public bool $isCreated = false;

    public string $message = '';

    public ?string $userId = null;
}
