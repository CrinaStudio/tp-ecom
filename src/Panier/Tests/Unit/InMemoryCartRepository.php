<?php

namespace Src\Panier\Tests\Unit;

use Src\Panier\Domain\Cart;
use Src\Panier\Domain\Repository\CartRepository;

class InMemoryCartRepository implements CartRepository
{
    /**
     * @var Cart[]
     */
    private array $cart = [];

    public function save(Cart $cart): void
    {
        $this->cart[$cart->userId()] = $cart;
    }

    public function findByUserId(string $userId): ?Cart
    {
        return $this->cart[$userId] ?? null;
    }
}
