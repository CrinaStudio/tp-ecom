<?php

namespace Src\User\Infrastructure\Repository;

use Illuminate\Support\Facades\Auth;
use Src\User\Domain\Repository\AuthRepositoryInterface;
use function PHPUnit\Framework\isFalse;
use Src\User\Infrastructure\Models\User;

class EloquentAuthRepository implements AuthRepositoryInterface
{
    public function authUser(array $userData): void
    {
        $userFind = User::query()->where(['id'=> $userData['id']])->first();
        Auth::login($userFind);
    }
}
