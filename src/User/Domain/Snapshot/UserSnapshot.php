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
}
