<?php

namespace Src\User\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Src\Shared\Domain\Exceptions\NotEmptyException;
use Src\Shared\Domain\IdGenerator;
use Src\Shared\Tests\Unit\FixedIdGenerator;
use Src\User\Application\Command\Create\CreateUserCommand;
use Src\User\Application\Command\Create\CreateUserHandler;
use Src\User\Application\Command\Create\CreateUserResponse;
use Src\User\Domain\Exceptions\AlreadyEmailExistException;
use Src\User\Domain\Hasher;
use Src\User\Domain\Repositories\WriteUserRepository;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    private IdGenerator $idGenerator;

    private WriteUserRepository $repository;

    private Hasher $hasher;

    /**
     * @throws NotEmptyException
     * @throws AlreadyEmailExistException
     */
    #[Test]
    public function should_create_user(): void
    {
        $command = new CreateUserCommand(
            name: 'John Doe',
            email: 'john@doe.com',
            password: 'password',
        );

        $response = $this->createUser($command);

        $this->assertTrue($response->isSaved);
        $this->assertEquals('Utilisateur crée avec succès !', $response->message);
    }

    /**
     * @throws NotEmptyException
     * @throws AlreadyEmailExistException
     */
    private function createUser(CreateUserCommand $command): CreateUserResponse
    {
        $handler = new CreateUserHandler(
            repository: $this->repository,
            idGenerator: $this->idGenerator,
            hasher: $this->hasher
        );

        return $handler->handle($command);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->idGenerator = new FixedIdGenerator;
        $this->repository = new InMemoryWriteUserRepository;
        $this->hasher = new FakeHasher;
    }
}
