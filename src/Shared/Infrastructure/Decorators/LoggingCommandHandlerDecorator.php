<?php

namespace Src\Shared\Infrastructure\Decorators;

use Illuminate\Support\Facades\App;
use Psr\Log\LoggerInterface;
use Src\Shared\Domain\Command;
use Src\Shared\Domain\CommandHandler;
use Throwable;

final readonly class LoggingCommandHandlerDecorator implements CommandHandler
{
    public function __construct(
        private CommandHandler  $commandHandler,
        private LoggerInterface $logger
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(Command $command): object
    {
        if (!App::environment(['local', 'testing'])) {
            $commandClass = get_class($command);
            $this->logger->info("Début d'exécution de la commande $commandClass", [
                'command_data' => json_encode($command, JSON_PRETTY_PRINT),
            ]);

            $startTime = microtime(true);

            try {
                $result = $this->commandHandler->handle($command);

                $executionTime = microtime(true) - $startTime;
                $this->logger->info("Commande $commandClass exécutée avec succès", [
                    'execution_time' => $executionTime,
                    'result' => json_encode($result, JSON_PRETTY_PRINT),
                ]);

                return $result;
            } catch (Throwable $e) {
                $executionTime = microtime(true) - $startTime;
                $this->logger->error("Erreur lors de l'exécution de la commande $commandClass", [
                    'execution_time' => $executionTime,
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                throw $e;
            }
        }
        return $this->commandHandler;
    }
}
