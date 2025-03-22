<?php

namespace Src\Shared\Infrastructure\Factory;

use Illuminate\Database\ConnectionInterface;
use Psr\Log\LoggerInterface;
use Src\Shared\Domain\CommandHandler;
use Src\Shared\Infrastructure\Decorators\LoggingCommandHandlerDecorator;
use Src\Shared\Infrastructure\Decorators\TransactionalCommandHandlerDecorator;

readonly class DecorateHandlerFactory
{
    public function __construct(
        private ConnectionInterface $connection,
        private LoggerInterface $logger
    ) {}

    public function decorate(CommandHandler $commandHandler): CommandHandler
    {
        $loggingHandler = new LoggingCommandHandlerDecorator($commandHandler, $this->logger);

        return new TransactionalCommandHandlerDecorator($loggingHandler, $this->connection);
    }
}
