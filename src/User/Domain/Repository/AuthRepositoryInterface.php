<?php

namespace Src\User\Domain\Repository;

use Src\Auth\Domain\Entities\AuthUser;

interface AuthRepositoryInterface
{
    /**
     * @param \Src\Auth\Domain\Entities\AuthUser $userData
     * @return void
     */
    public function authUser(AuthUser $userData): void;
}
