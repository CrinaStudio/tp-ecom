<?php

namespace Src\Auth\Tests\E2E;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Src\User\Infrastructure\Models\User;
use Tests\TestCase;

class AuthActionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function as_user_can_login_with_valid_credentials(): void
    {
        // given
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);
        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        // when
        $response = $this->postJson('/login', $data);

        // then
        $response->assertStatus(200);
        $this->assertTrue($response->json()['isLoggedIn']);

    }

    #[Test]
    public function as_user_cannot_login_with_invalid_credentials(): void
    {
        // given
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);
        $data = [
            'email' => $user->email,
            'password' => 'invalid-password',
        ];

        // when
        $response = $this->postJson('/login', $data);

        // then
        $response->assertUnauthorized();
        $response->assertJson([
            'message' => 'Invalid email or password',
        ]);
        $this->assertFalse($response->json()['isLoggedIn']);
        $this->assertEmpty($response->json()['token']);

    }

    #[Test]
    public function as_user_can_logout_when_authenticated(): void
    {
        // given
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        // when
        $response = $this->actingAs($user)->postJson('/logout');

        // then
        $response->assertStatus(200);
        $this->assertTrue($response->json()['isLoggedOut']);
        $this->assertEmpty($user->tokens->toArray());
    }

    #[Test]
    public function as_guest_cannot_logout(): void
    {
        // given
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        // when
        $response = $this->postJson('/logout');

        // then
        $response->assertUnauthorized();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }
}
