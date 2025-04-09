<?php

namespace Src\User\Tests\E2E;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Src\User\Domain\Enums\RoleEnum;
use Tests\TestCase;

class RegisterUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    #[Test]
    public function should_register_user()
    {
        $data = [
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'name' => 'Test User',
            'role' => RoleEnum::CUSTOMER->value,
        ];
        $response = $this->postJson('/register', $data);

        $response->assertStatus(201);
        $this->assertTrue($response->json()['isCreated']);
        $this->assertNotNull($response->json()['id']);
    }
}
