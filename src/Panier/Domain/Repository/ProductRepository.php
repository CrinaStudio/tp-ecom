<?php

namespace Src\Panier\Domain\Repository;

use Src\Panier\Domain\Product;

interface ProductRepository
{
    public function ofId(string $productId): ?Product;
}
