<?php

namespace Src\Panier\Tests\Unit;

use Src\Panier\Domain\Product;
use Src\Panier\Domain\Repository\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    /**
     * @var Product[]
     */
    public array $products = [];

    public function __construct()
    {
        $this->products = [
            '3fa85f64-5717-4562-b3fc-2c963f66afa6' => new Product(
                '3fa85f64-5717-4562-b3fc-2c963f66afa6',
                'Chaise ergonomique',
                129.99,
                645,
                'Mobilier',
                'Le Djoor'
            ),
            '1b645389-2473-446d-a3be-4d3b95292bdf' => new Product(
                '1b645389-2473-446d-a3be-4d3b95292bdf',
                'Écran 27 pouces',
                249.99,
                6445,
                'Informatique',
                'Le Djoor'
            ),
            '6f4922f4-3d8c-46eb-a442-284a0db3f4a0' => new Product(
                '6f4922f4-3d8c-46eb-a442-284a0db3f4a0',
                'Casque Bluetooth',
                59.99,
                6450,
                'Audio',
                'Le Djoor'
            ),
            '9ae0ea9e-0eeb-46f5-9ba0-dc4a6b1b9c47' => new Product(
                '9ae0ea9e-0eeb-46f5-9ba0-dc4a6b1b9c47',
                'Clavier mécanique',
                89.99,
                644,
                'Informatique',
                'Le Djoor'
            ),
        ];
    }

    public function ofId(string $productId): ?Product
    {
        return $this->products[$productId] ?? null;
    }
}
