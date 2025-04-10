<?php

namespace Src\User\Application\Command\Register;

use Src\Auth\Domain\Entities\AuthUser;
use Src\Shared\Domain\Exceptions\InvalidCommandException;
use Src\User\Domain\Entities\User;
use Src\User\Domain\Enums\RoleEnum;
use Src\User\Domain\Exceptions\AlreadyExistEmailException;
use Src\User\Domain\Repository\AuthRepositoryInterface;
use Src\User\Domain\Repository\UserRepositoryInterface;

readonly class RegisterUserHandler
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private AuthRepositoryInterface $authRepository
    ) {}

    public function handle(RegisterUserCommand $command): RegisterUserResponse
    {
        $response = new RegisterUserResponse;

        try {
            $this->checkIfUserExistOrThrowNotFoundException($command->email);
            $role = RoleEnum::in($command->role);
        } catch (InvalidCommandException|AlreadyExistEmailException $e) {
            $response->message = $e->getMessage();

            return $response;
        }

        $user = User::create(
            $command->email,
            $command->password,
            $role,
            $command->name
        );

        $this->repository->create($user);

        $authUser = AuthUser::authenticate($user);
        $this->authRepository->authUser($authUser);

        $response->isCreated = true;
        $response->message = 'Registered successfully';
        $response->userId = $user->snapshot()->id;
        $response->isAuthenticated = $authUser->isAuthenticated;

        return $response;
    }

    /**
     * @throws AlreadyExistEmailException
     */
    private function checkIfUserExistOrThrowNotFoundException(string $email): void
    {
        if ($this->repository->existByEmail($email)) {
            throw new AlreadyExistEmailException('Cet email existe deja !');
        }

    }
}
