<?php

namespace Src\User\Infrastructure\Repository;

use Src\User\Domain\Entities\User;
use Src\User\Domain\Repository\UserRepositoryInterface;
use Src\User\Infrastructure\Models\User as UserModel;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct() {}

    public function create(User $user): void
    {
        UserModel::query()->create($user->snapshot()->toArray());
    }

    public function existByEmail(string $email): bool
    {
        return UserModel::query()->where('email', $email)->exists();
    }
}
