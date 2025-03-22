<?php

namespace Src\Shared\Infrastructure\Factory;

use Illuminate\Database\ConnectionInterface;
use Src\Shared\Domain\CommandHandler;
use Src\Shared\Infrastructure\Decorators\TransactionalCommandHandlerDecorator;

readonly class TransactionalHandlerFactory
{
    public function __construct(
        private ConnectionInterface $connection,
    )
    {
    }

    public function decorate(CommandHandler $commandHandler): CommandHandler
    {
        return new TransactionalCommandHandlerDecorator($commandHandler, $this->connection);
    }
}
