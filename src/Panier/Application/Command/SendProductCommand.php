<?php

namespace Src\Panier\Application\Command;

readonly class SendProductCommand
{
    public function __construct(
        public string $productId,
        public string $userId,
        public int    $quantity
    ){}
}
