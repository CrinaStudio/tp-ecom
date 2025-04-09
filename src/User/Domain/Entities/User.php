<?php

namespace Src\User\Domain\Entities;

use Src\User\Domain\Snapshot\UserSnapshot;

class User
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $password,
        private string $role,

    ) {}

    public static function create(string $email, string $password, string $role, string $name): User
    {
        return new self(
            id: uniqid(),
            name: $name,
            email: $email,
            password: $password,
            role: $role
        );
    }

    public function snapshot(): UserSnapshot
    {
        return new UserSnapshot(
            id: $this->id,
            name: $this->name,
            email: $this->email,
            password: $this->password,
            role: $this->role
        );
    }
}
