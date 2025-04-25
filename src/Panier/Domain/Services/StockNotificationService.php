<?php

namespace Src\Panier\Domain\Services;

use Src\Panier\Domain\Product;

interface StockNotificationService
{
    public function notifyLowStock(Product $product): void;

}
