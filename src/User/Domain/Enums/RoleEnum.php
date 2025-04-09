<?php

namespace Src\User\Domain\Enums;

use Src\Shared\Domain\Exceptions\InvalidCommandException;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case CUSTOMER = 'client';

    /**
     * @throws InvalidCommandException
     */
    public static function in(string $role): self
    {
        $enum = self::tryFrom($role);
        if ($enum === null) {
            throw new InvalidCommandException('Ce role n\'est pas valide !');
        }

        return $enum;
    }
}
