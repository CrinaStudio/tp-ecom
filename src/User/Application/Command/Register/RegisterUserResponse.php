<?php

namespace Src\User\Application\Command\Register;

use Src\Auth\Domain\Entities\AuthUser;

class RegisterUserResponse
{
    public bool $isCreated = false;

    public string $message = '';
    public ?string $userId = null;

    public AuthUser $authenticated;
}
