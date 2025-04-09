<?php

namespace Src\User\Application\Command\Register;

use Src\Shared\Domain\Exceptions\InvalidCommandException;

readonly class RegisterUserCommand
{
    /**
     * @throws InvalidCommandException
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $passwordConfirmation,
        public string $role
    ) {
        $this->validate();
    }

    /**
     * @throws InvalidCommandException
     */
    private function validate(): void
    {
        if ($this->passwordConfirmation !== $this->password) {
            throw new InvalidCommandException('Les mots de passe ne correspondent pas !');
        }
    }
}
