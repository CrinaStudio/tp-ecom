<?php

namespace Src\Auth\Domain\Entities;

use Src\User\Domain\Entities\User;

class AuthUser
{
    public function __construct(
        public string $id,
        public bool $isAuthenticated
    ) {}

    public static function authenticate(User $user): self
    {
        return new self(
            id: $user->snapshot()->id,
            isAuthenticated: true,
        );
    }
}
