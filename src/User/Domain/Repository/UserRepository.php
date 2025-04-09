<?php

namespace Src\User\Domain\Repository;

use Src\User\Domain\Entities\User;

interface UserRepository
{
    public function create(User $user): void;

    public function existByEmail(string $email): bool;
}
