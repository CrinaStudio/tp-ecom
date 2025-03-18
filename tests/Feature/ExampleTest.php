<?php

use Illuminate\Support\Facades\DB;
use Src\User\Infrastructure\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }


    public function test_database_is_correct()
    {
        $dbName = DB::select('SELECT DATABASE() as db')[0]->db;
        $this->assertEquals('laravel_test_db', $dbName, "Expected laravel_test_db but got $dbName");
    }

    public function test_it_creates_a_user()
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }
}
