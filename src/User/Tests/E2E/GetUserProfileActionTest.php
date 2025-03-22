<?php

namespace Src\User\Tests\E2E;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Src\User\Infrastructure\Models\User;
use Tests\TestCase;

class GetUserProfileActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    #[Test]
    public function should_get_user_profile(): void
    {
        $sut = $this->buildSUT();
        $this->assertDatabaseCount('users', 1);
        $userId = $sut['userId'];

        $response = $this->getJson("/users/$userId");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'createdAt',
            ],
        ]);
    }

    private function buildSUT(): array
    {
        return [
            'userId' => User::factory()->create()->id,
        ];
    }
}
