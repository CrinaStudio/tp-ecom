<?php

namespace Src\User\Domain\Snapshot;

readonly class UserSnapshot
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $password,
        public string $role
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password,
        ];
    }
}
