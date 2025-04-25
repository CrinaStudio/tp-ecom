<?php

namespace Src\Panier\Domain;

use Src\Panier\Domain\Exceptions\LowStockException;

class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    /**
     * @var Product[]
     */
    private array $products = [];

    public function __construct(
        private readonly string $id,
        private readonly string $userId
    )
    {
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function Id(): string
    {
        return $this->id;
    }

    /**
     * @throws \Src\Panier\Domain\Exceptions\LowStockException
     */
    public static function create(string $userId, string $productId, int $quantity, Product $product): self
    {
        $cart = new self(
            self::generateUuid(),
            $userId
        );
        $cart->verifyProductInStockQuantity($product, $quantity);
        $cart->addItem($productId, $quantity, $product);

        return $cart;
    }

    /**
     * @throws \Src\Panier\Domain\Exceptions\LowStockException
     */
    private function verifyProductInStockQuantity(Product $product, int $quantity): void
    {
        if ($product->stock < $quantity) {
            throw new LowStockException('Quantité demandée non disponible en stock');
        }
    }

    public function addItem(string $productId, int $quantity, Product $product): void
    {
        $this->products[$productId] = $product;

        $existingItemIndex = $this->findItemIndexByProductId($productId);

        if ($existingItemIndex !== null) {
            $currentQuantity = $this->items[$existingItemIndex]->getQuantity();
            $this->items[$existingItemIndex]->updateQuantity(($currentQuantity + $quantity));
        } else {
            $cartItem = new CartItem(
                self::generateUuid(),
                $productId,
                $quantity,
                $product->price,
                $product->name
            );

            $this->items[] = $cartItem;
        }
    }

    private function findItemIndexByProductId(string $productId): ?int
    {
        foreach ($this->items as $index => $item) {
            if ($item->productId() === $productId) {
                return $index;
            }
        }

        return null;
    }

    private static function generateUuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF),
            mt_rand(0, 0xFFFF),
            mt_rand(0, 0x0FFF) | 0x4000,
            mt_rand(0, 0x3FFF) | 0x8000,
            mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF)
        );
    }

    /**
     * @return CartItem[]
     */
    public function items(): array
    {
        return $this->items;
    }

    public function calculateTotalPrice(): float
    {
        $total = 0.0;

        foreach ($this->items as $item) {
            $productId = $item->productId();
            $quantity = $item->getQuantity();

            if (isset($this->products[$productId])) {
                $product = $this->products[$productId];
                $total += $product->getDiscountedPrice() * $quantity;
            } else {
                $total += $item->price() * $quantity;
            }
        }

        return $total;
    }
}
