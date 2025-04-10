<?php

namespace Src\User\Domain\Repository;

use Src\User\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function create(User $user): void;

    public function existByEmail(string $email): bool;
}
