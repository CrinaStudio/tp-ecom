<?php

namespace Src\Panier\Domain;

class CartItem
{
    public function __construct(
        private string $id,
        private string $productId,
        private int $quantity,
        private float $price,
        private string $productName
    ) {}

    public function getSubtotal(): float
    {
        return $this->price * $this->quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function productId()
    {
        return $this->productId;
    }
    public function updateQuantity(int $newQuantity): void
    {
        if ($newQuantity <= 0) {
            throw new \InvalidArgumentException('La quantité doit être supérieure à zéro');
        }

        $this->quantity = $newQuantity;
    }

    public function price(): float
    {
        return $this->price;
    }
}
