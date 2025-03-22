<?php

namespace Src\Shared\Infrastructure\Decorators;

use Illuminate\Database\ConnectionInterface;
use Src\Shared\Domain\Command;
use Src\Shared\Domain\CommandHandler;
use Throwable;

readonly class TransactionalCommandHandlerDecorator implements CommandHandler
{
    public function __construct(
        private CommandHandler      $handler,
        private ConnectionInterface $connection
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(Command $command): object
    {
        return $this->connection->transaction(function () use ($command) {
            return $this->handler->handle($command);
        });
    }
}
