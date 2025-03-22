<?php

namespace Src\User\Infrastructure\Service;

use Illuminate\Support\Facades\Hash;
use Src\User\Domain\Hasher;

class LaravelHasher implements Hasher
{

    public function hash(string $password): string
    {
       return Hash::make($password);
    }

    public function check(string $password, string $hashedPassword): bool
    {
       return Hash::check($password, $hashedPassword);
    }
}
