<?php

namespace Src\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Src\User\Domain\Enums\RoleEnum;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Domain\User;
use Src\User\Infrastructure\Repository\EloquentUserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private UserRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new EloquentUserRepository;
        $this->refreshDatabase();
    }

    #[Test]
    public function should_save_user()
    {
        $user = User::create(
            email: 'test@test.com',
            password: 'password',
            role: RoleEnum::CUSTOMER,
            name: 'John Doe'
        );
        $this->repository->create($user);

        $this->assertCount(1, \Src\User\Infrastructure\Models\User::all()->toArray());
        $this->assertDatabaseHas('users', [
            'email' => $user->snapshot()->email,
            'role' => $user->snapshot()->role,
            'name' => $user->snapshot()->name,
        ]);

    }
}
