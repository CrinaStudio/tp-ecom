<?php

namespace Tests;

use Exception;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use PDO;
use Testcontainers\Container\StartedGenericContainer;
use Testcontainers\Modules\MySQLContainer;
use Throwable;

abstract class TestCase extends BaseTestCase
{
    protected static ?StartedGenericContainer $startedContainer = null;
    protected static ?MySQLContainer $mySQLContainer = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if (is_null(self::$mySQLContainer)) {
            try {
                self::$mySQLContainer = new MySQLContainer('mysql:8.0');
                self::$mySQLContainer->withEnvironment([
                    'MYSQL_DATABASE' => env('DB_DATABASE', 'laravel_test_db'),
                    'MYSQL_USER' => env('DB_USERNAME', 'laravel_test_user'),
                    'MYSQL_PASSWORD' => env('DB_PASSWORD', 'secret'),
                    'MYSQL_ROOT_PASSWORD' => env('DB_PASSWORD', 'root'),
                ]);
                self::$startedContainer = self::$mySQLContainer->start();
                try {
                    new PDO(
                        "mysql:host=" . self::$startedContainer->getHost() . ";port=" . self::$startedContainer->getMappedPort(3306),
                        env('DB_USERNAME', 'laravel_test_user'),
                        env('DB_PASSWORD', 'secret')
                    );
                    echo "✅ Connexion MySQL Test containers réussie";
                } catch (Exception $e) {
                    echo "❌ Connexion MySQL échouée : " . $e->getMessage();
                }
            } catch (Throwable $e) {
                fwrite(STDERR, "❌ Erreur lors du démarrage du conteneur MySQL: " . $e->getMessage() . "\n");
                exit(1);
            }

        }
    }

    public function setUp(): void
    {
        parent::setUp();
        if (!self::$mySQLContainer || !self::$startedContainer) {
            $this->markTestSkipped('❌ Le conteneur MySQL n’a pas été démarré correctement.');
        }

        config()->set('database.connections.mysql.host', self::$startedContainer->getHost());
        config()->set('database.connections.mysql.port', self::$startedContainer->getMappedPort(3306));
        config()->set('database.connections.mysql.database', env('DB_DATABASE', 'laravel_test_db'));
        config()->set('database.connections.mysql.username', env('DB_USERNAME', 'laravel_test_user'));
        config()->set('database.connections.mysql.password', env('DB_PASSWORD', 'secret'));

        Artisan::call('migrate:fresh'); // Réinitialise la base avant chaque test

    }

    public function tearDown(): void
    {

        if (self::$mySQLContainer) {
            self::$startedContainer->stop();
            self::$mySQLContainer = null;
        }

        parent::tearDownAfterClass();
    }

}
