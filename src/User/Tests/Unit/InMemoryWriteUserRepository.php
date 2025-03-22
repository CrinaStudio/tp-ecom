<?php

namespace Src\User\Tests\Unit;

use Src\User\Domain\Repositories\WriteUserRepository;
use Src\User\Domain\Snapshot\UserSnapshot;

class InMemoryWriteUserRepository implements WriteUserRepository
{
    public array $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function save(UserSnapshot $user): void
    {
        $this->users[$user->id] = $user;
    }

    public function emailExists(string $email, ?string $userId): bool
    {
        $userExist = array_find($this->users, function (UserSnapshot $user) use ($email, $userId) {
            return $user->email === $email && $user->id === $userId;
        });

        return ! is_null($userExist);
    }
}
