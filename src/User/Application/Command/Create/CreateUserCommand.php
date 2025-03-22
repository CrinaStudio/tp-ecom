<?php

namespace Src\User\Application\Command\Create;

readonly class CreateUserCommand
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}
