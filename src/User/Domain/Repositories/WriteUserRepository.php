<?php

namespace Src\User\Domain\Repositories;

use Src\User\Domain\Snapshot\UserSnapshot;

interface WriteUserRepository
{
    public function save(UserSnapshot $user): void;

    public function emailExists(string $email, ?string $userId): bool;
}
