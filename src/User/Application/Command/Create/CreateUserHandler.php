<?php

namespace Src\User\Application\Command\Create;

use Src\Shared\Domain\Exceptions\NotEmptyException;
use Src\Shared\Domain\IdGenerator;
use Src\User\Domain\Entities\User;
use Src\User\Domain\Exceptions\AlreadyEmailExistException;
use Src\User\Domain\Hasher;
use Src\User\Domain\Repositories\WriteUserRepository;

final readonly class CreateUserHandler
{
    public function __construct(
        private WriteUserRepository $repository,
        private IdGenerator $idGenerator,
        private Hasher $hasher,
    ) {}

    /**
     * @throws AlreadyEmailExistException
     * @throws NotEmptyException
     */
    public function handle(CreateUserCommand $command): CreateUserResponse
    {
        $response = new CreateUserResponse;

        $this->checkIfEmailAlreadyExistOrThrowException($command);
        $user = User::create(
            name: $command->name,
            email: $command->email,
            password: $command->password,
            userId: $this->idGenerator->generate(),
            hasher: $this->hasher,
        );
        $this->repository->save($user->snapshot());

        $response->isSaved = true;
        $response->userId = $user->snapshot()->id;
        $response->code = 201;
        $response->message = 'Utilisateur crée avec succès !';

        return $response;
    }

    /**
     * @throws AlreadyEmailExistException
     */
    private function checkIfEmailAlreadyExistOrThrowException(CreateUserCommand $command): void
    {
        if ($this->repository->emailExists($command->email, null)) {
            throw new AlreadyEmailExistException;
        }
    }
}
