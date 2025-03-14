<?php

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }


    public function test_it_creates_a_user()
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }
}
