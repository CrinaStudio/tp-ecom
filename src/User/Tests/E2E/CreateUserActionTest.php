<?php

namespace Src\User\Tests\E2E;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Src\User\Domain\Repositories\WriteUserRepository;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    public function test_can_create_user(): void
    {
        // 1. Arrange - Préparer les données de test
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'StrongPassword123!',
            'password_confirmation' => 'StrongPassword123!',
        ];

        // 2. Act - Faire la requête vers l'API
        $response = $this->postJson('/api/users', $userData);

        // 3. Assert - Vérifier les résultats

        // Vérifier le statut HTTP et la structure de la réponse
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data',
            ]);

        // Vérifier que l'utilisateur existe en base de données
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);

        // Récupérer l'utilisateur créé et vérifier le hash du mot de passe
        $user = DB::table('users')->where('email', 'john.doe@example.com')->first();
        $this->assertNotNull($user);
        $this->assertNotEquals('StrongPassword123!', $user->password, 'Le mot de passe ne doit pas être stocké en clair');
    }

    public function test_cannot_create_user_with_existing_email(): void
    {
        // 1. Arrange - Créer un utilisateur existant
        $existingUserData = [
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'password' => 'StrongPassword123!',
            'password_confirmation' => 'StrongPassword123!',
        ];

        $this->postJson('/api/users', $existingUserData);

        // 2. Act - Tenter de créer un nouvel utilisateur avec le même email
        $newUserData = [
            'name' => 'New User',
            'email' => 'existing@example.com', // Même email
            'password' => 'AnotherPassword456!',
            'password_confirmation' => 'AnotherPassword456!',
        ];

        $response = $this->postJson('/api/users', $newUserData);

        // 3. Assert - Vérifier que la création échoue
        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors',
            ]);

        // Vérifier qu'un seul utilisateur avec cet email existe
        $this->assertEquals(1, DB::table('users')->where('email', 'existing@example.com')->count());
    }

    public function test_cannot_create_user_with_invalid_data(): void
    {
        // 1. Arrange - Préparer des données invalides
        $invalidUserData = [
            'name' => '', // Nom vide
            'email' => 'not-an-email', // Email invalide
            'password' => '123', // Mot de passe trop court
            'password_confirmation' => '1234', // Ne correspond pas
        ];

        // 2. Act - Faire la requête vers l'API
        $response = $this->postJson('/api/users', $invalidUserData);

        // 3. Assert - Vérifier que la création échoue avec les bonnes erreurs
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);

        // Vérifier qu'aucun utilisateur n'a été créé
        $this->assertEquals(0, DB::table('users')->count());
    }

    public function test_transaction_rollback_on_error(): void
    {
        // Ce test vérifie que la transaction est bien annulée en cas d'erreur

        // 1. Arrange - Créer un mock du repository qui échoue après avoir inséré en DB
        $this->mock(WriteUserRepository::class, function ($mock) {
            $mock->shouldReceive('save')->andThrow(new Exception('Erreur simulée'));
            $mock->shouldReceive('emailExists')->andReturn(false);
        });

        $userData = [
            'name' => 'Transaction Test',
            'email' => 'transaction@example.com',
            'password' => 'StrongPassword123!',
            'password_confirmation' => 'StrongPassword123!',
        ];

        // 2. Act - Faire la requête qui va échouer
        $response = $this->postJson('/api/users', $userData);

        // 3. Assert - Vérifier que la création a échoué et qu'aucun utilisateur n'a été créé
        $response->assertStatus(500);

        $this->assertDatabaseMissing('users', [
            'email' => 'transaction@example.com',
        ]);
    }
}
