<?php

namespace Src\User\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Src\Shared\Domain\Exceptions\InvalidCommandException;
use Src\User\Application\Command\Register\RegisterUserCommand;
use Src\User\Application\Command\Register\RegisterUserHandler;
use Src\User\Application\Command\Register\RegisterUserResponse;
use Src\User\Domain\Entities\User;
use Src\User\Domain\Enums\RoleEnum;
use Src\User\Domain\Repository\AuthRepositoryInterface;
use Src\User\Domain\Repository\UserRepositoryInterface;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    private UserRepositoryInterface $repository;

    private AuthRepositoryInterface $authRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryUserRepository;
        $this->authRepository = new InMemoryAuthRepository;
    }

    #[Test]
    public function a_user_can_be_registered_with_valid_data(): void
    {
        // given
        $command = new RegisterUserCommand(
            name: 'John Doe',
            email: 'john@doe.com',
            password: 'password',
            passwordConfirmation: 'password',
            role: 'admin'
        );

        // when
        $response = $this->registerUser($command);

        $this->assertTrue($response->isCreated);
        $this->assertEquals('Registered successfully', $response->message);
        $this->assertNotNull($response->userId);
        $this->assertCount(1, $this->repository->all());
        $this->assertTrue($this->authRepository->hasAuthenticatedUser($response->userId));
    }

    private function registerUser(RegisterUserCommand $command): RegisterUserResponse
    {
        $handler = new RegisterUserHandler(repository: $this->repository, authRepository: $this->authRepository);

        return $handler->handle($command);
    }

    #[Test]
    public function registration_fails_if_passwords_do_not_match(): void
    {
        // given
        $this->expectException(InvalidCommandException::class);
        $this->expectExceptionMessage('Les mots de passe ne correspondent pas !');
        new RegisterUserCommand(
            name: 'John Doe',
            email: 'john@doe.com',
            password: 'password',
            passwordConfirmation: 'not-match-password',
            role: 'admin'
        );
    }

    #[Test]
    public function role_must_be_valid(): void
    {
        // given
        $command = new RegisterUserCommand(
            name: 'John Doe',
            email: 'john@doe.com',
            password: 'password',
            passwordConfirmation: 'password',
            role: 'not-valid-role'
        );

        // when
        $response = $this->registerUser($command);
        // then

        $this->assertFalse($response->isCreated);
        $this->assertEquals('Ce role n\'est pas valide !', $response->message);
        $this->assertNull($response->userId);
    }

    /**
     * @throws InvalidCommandException
     */
    #[Test]
    public function registration_fails_if_email_is_already_taken(): void
    {
        $this->buildSut();

        // given
        $command = new RegisterUserCommand(
            name: 'John Doe',
            email: 'john@doe.com',
            password: 'password',
            passwordConfirmation: 'password',
            role: RoleEnum::CUSTOMER->value
        );

        // when
        $response = $this->registerUser($command);
        // then

        $this->assertFalse($response->isCreated);
        $this->assertEquals('Cet email existe deja !', $response->message);
        $this->assertNull($response->userId);
        $this->assertCount(2, $this->repository->all());
    }

    private function buildSut(): void
    {
        $eUser1 = User::create(
            email: 'john@doe.com',
            password: 'password',
            role: RoleEnum::CUSTOMER,
            name: 'John Doe'
        );
        $eUser2 = User::create(
            email: 'jane@doe.com',
            password: 'password',
            role: RoleEnum::CUSTOMER,
            name: 'Jane Doe'
        );
        $this->repository->create($eUser1);
        $this->repository->create($eUser2);
    }
}
