<?php

namespace Src\User\Infrastructure\Repository;

use Src\User\Domain\Repositories\WriteUserRepository;
use Src\User\Domain\Snapshot\UserSnapshot;
use Src\User\Infrastructure\Models\User;

class EloquentWriteUserRepository implements WriteUserRepository
{
    public function save(UserSnapshot $user): void
    {
        User::query()->create($user->toArray());
    }

    public function emailExists(string $email, ?string $userId): bool
    {
        return User::query()
            ->where('email', $email)
            ->when($userId !== null, function ($query) use ($userId) {
                return $query->where('id', '!=', $userId);
            })
            ->exists();
    }
}
