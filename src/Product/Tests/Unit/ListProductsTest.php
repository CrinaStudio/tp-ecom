<?php

namespace Src\Produits\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListProductsTest extends TestCase
{
    private array $products;

    protected function setUp(): void
    {
        parent::setUp();
        $this->buildSUT();
    }

    #[Test]
    public function getAllProducts()
    {


    }

    public function buildSUT(){
        $this->products = [
            [
                'id' => '3fa85f64-5717-4562-b3fc-2c963f66afa6',
                'name' => 'Chaise ergonomique',
                'price' => 129.99,
                'category' => 'Mobilier',
            ],
            [
                'id' => '1b645389-2473-446d-a3be-4d3b95292bdf',
                'name' => 'Écran 27 pouces',
                'price' => 249.99,
                'category' => 'Informatique',
            ],
            [
                'id' => '6f4922f4-3d8c-46eb-a442-284a0db3f4a0',
                'name' => 'Casque Bluetooth',
                'price' => 59.99,
                'category' => 'Audio',
            ],
            [
                'id' => '9ae0ea9e-0eeb-46f5-9ba0-dc4a6b1b9c47',
                'name' => 'Clavier mécanique',
                'price' => 89.99,
                'category' => 'Informatique',
            ],
        ];
    }
}
