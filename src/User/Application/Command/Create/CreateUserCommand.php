<?php

namespace Src\User\Application\Command\Create;

use Src\Shared\Domain\Command;

readonly class CreateUserCommand extends Command
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}
