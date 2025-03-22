<?php

namespace Src\User\Domain;

interface Hasher
{
    public function hash(string $password): string;

    public function check(string $password, string $hashedPassword): bool;
}
