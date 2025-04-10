<?php

namespace Src\User\Application\Command\Register;

use Src\User\Domain\Entities\User;

class RegisterUserResponse
{
    public bool $isCreated = false;

    public string $message = '';

    public ?string $userId = null;

    public bool $isAuthenticated = false;

    public User $user;
}
