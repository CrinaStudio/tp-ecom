<?php

namespace Src\Panier\Application\Command\Sales;

use DateTime;
use Src\Panier\Domain\Product;

class SalesServiceCommand
{
    private DateTime $startDate;

    private DateTime $endDate;

    private float $discountPercentage;

    private int $maxProductCount;

    private array $discountedProducts = [];

    public function __construct(
        DateTime $startDate,
        DateTime $endDate,
        float $discountPercentage,
        int $maxProductCount
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->discountPercentage = $discountPercentage;
        $this->maxProductCount = $maxProductCount;
    }

    private function isOnSalePeriod(): bool
    {
        $now = new DateTime;

        return $now >= $this->startDate && $now <= $this->endDate;
    }

    public function applyDiscountToProduct(Product $product): void
    {
        if (! $this->isOnSalePeriod()) {
            return;
        }

        if (! $product->isLeDjoor()) {
            return;
        }

        if (count($this->discountedProducts) >= $this->maxProductCount) {
            return;
        }

        $product->applyDiscount($this->discountPercentage);
        $this->discountedProducts[] = $product->id;
    }

    //    public function applyDiscountToProducts(array $products): void
    //    {
    //        if (!$this->isOnSalePeriod()) {
    //            return;
    //        }
    //
    //        $djoorProducts = array_filter($products, function(Product $product) {
    //            return $product->isLeDjoor();
    //        });
    //
    //        $productsToDiscount = array_slice($djoorProducts, 0, $this->maxProductCount);
    //
    //        foreach ($productsToDiscount as $product) {
    //            $product->applyDiscount($this->discountPercentage);
    //            $this->discountedProducts[] = $product->id;
    //        }
    //    }

    //    public function getDiscountedProductCount(): int
    //    {
    //        return count($this->discountedProducts);
    //    }
    //
    //    public function updateSaleSettings(
    //        DateTime $startDate,
    //        DateTime $endDate,
    //        float $discountPercentage,
    //        int $maxProductCount
    //    ): void {
    //        $this->startDate = $startDate;
    //        $this->endDate = $endDate;
    //        $this->discountPercentage = $discountPercentage;
    //        $this->maxProductCount = $maxProductCount;
    //    }
}
