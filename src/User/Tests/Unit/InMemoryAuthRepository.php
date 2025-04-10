<?php

namespace Src\User\Tests\Unit;

use Src\Auth\Domain\Entities\AuthUser;
use Src\User\Domain\Repository\AuthRepositoryInterface;

class InMemoryAuthRepository implements AuthRepositoryInterface
{
    private array $authenticatedUsers = [];

    public function authUser(AuthUser $authUser): void
    {
        $this->authenticatedUsers[] = $authUser;
    }

    public function hasAuthenticatedUser(string $userId): bool
    {
        foreach ($this->authenticatedUsers as $user)
        {
            if($userId == $user->id){
                return true;
            }
        }
        return false;
    }
}
