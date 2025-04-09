<?php

namespace Src\User\Tests\Unit;

use Src\User\Domain\Entities\User;
use Src\User\Domain\Repository\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private array $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function create(User $user): void
    {
        $this->users[] = $user;
    }

    public function existByEmail(string $email): bool
    {
        return ! empty(array_filter($this->users, function (User $user) use ($email) {
            return $user->snapshot()->email === $email;
        }));
    }

    public function all(): array
    {
        return $this->users;
    }
}
