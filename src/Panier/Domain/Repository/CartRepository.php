<?php

namespace Src\Panier\Domain\Repository;

use Src\Panier\Domain\Cart;

interface CartRepository
{
    public function save(Cart $cart): void;

    public function findByUserId(string $userId): ?Cart;

//    public function findUnpaidCarts(): array;
}
