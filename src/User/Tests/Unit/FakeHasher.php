<?php

namespace Src\User\Tests\Unit;

use Src\User\Domain\Hasher;

class FakeHasher implements Hasher
{
    public function hash(string $password): string
    {
        return 'hashed_password';
    }

    public function check(string $password, string $hashedPassword): bool
    {
        return $hashedPassword === $password;
    }
}
