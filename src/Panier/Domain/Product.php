<?php

namespace Src\Panier\Domain;

class Product
{
    private bool $isLeDjoor = false;

    private ?float $discountPercentage = 20;

    public function __construct(
        public string $id,
        public string $name,
        public float $price,
        public int $stock,
        public string $category,
        public ?string $brand = null
    ) {
        $this->isLeDjoor = $brand === 'Le Djoor';
    }

    public function isLeDjoor(): bool
    {
        return $this->isLeDjoor;
    }

    public function applyDiscount(?float $percentage): void
    {
        if ($this->isLeDjoor && $percentage !== null) {
            $this->discountPercentage = $percentage;
        }
    }

    public function getDiscountedPrice(): float
    {
        if ($this->isLeDjoor && $this->discountPercentage !== null) {
            return $this->price * (1 - $this->discountPercentage / 100);
        }

        return $this->price;
    }
}
