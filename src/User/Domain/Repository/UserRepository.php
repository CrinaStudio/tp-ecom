<?php

namespace Src\User\Domain\Repository;

use Src\User\Domain\User;

interface UserRepository
{
    public function create(User $user): void;

    public function existByEmail(string $email): bool;
}
