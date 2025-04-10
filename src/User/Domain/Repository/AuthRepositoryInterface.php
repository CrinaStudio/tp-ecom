<?php

namespace Src\User\Domain\Repository;

use Src\Auth\Domain\Entities\AuthUser;

interface AuthRepositoryInterface
{
    public function authUser(AuthUser $userData): void;
}
