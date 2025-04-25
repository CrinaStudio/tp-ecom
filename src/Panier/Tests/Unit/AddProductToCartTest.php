<?php

namespace Src\Panier\Tests\Unit;

use DateTime;
use PHPUnit\Framework\Attributes\Test;
use Src\Panier\Application\Command\AddProductToCardHandle;
use Src\Panier\Application\Command\Sales\SalesServiceCommand;
use Src\Panier\Application\Command\SendProductCommand;
use Src\Panier\Domain\Product;
use Tests\TestCase;

class AddProductToCartTest extends TestCase
{
    private InMemoryProductRepository $repository;

    private InMemoryCartRepository $cartRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryProductRepository;
        $this->cartRepository = new InMemoryCartRepository;
        $this->buildSUT();
    }

    #[Test]
    public function should_add_product_to_cart_when_product_exists()
    {
        // Arrange
        $userId = 'user-123';
        $productId = '3fa85f64-5717-4562-b3fc-2c963f66afa6';
        $quantity = 3;

        $product = new SendProductCommand(
            productId: $productId,
            userId: $userId,
            quantity: $quantity
        );

        $commandHandler = new AddProductToCardHandle(repository: $this->repository, cartRepository: $this->cartRepository);
        $response = $commandHandler->handle($product);

        $this->assertTrue($response->isAdded);
    }

    #[Test]
    public function should_define_sale_period_and_apply_discount_to_le_djoor_products()
    {
        // Arrange
        $userId = 'user-123';
        $productId = 'djoor-456';
        $quantity = 3;

        $startDate = new DateTime('-1 day');
        $endDate = new DateTime('+10 days');
        $discountPercentage = 20.0;
        $maxProductCount = 2;

        $salesService = new SalesServiceCommand(
            $startDate,
            $endDate,
            $discountPercentage,
            $maxProductCount
        );

        $product = new SendProductCommand(
            productId: $productId,
            userId: $userId,
            quantity: $quantity
        );

        // Act
        $commandHandler = new AddProductToCardHandle(
            repository: $this->repository,
            cartRepository: $this->cartRepository,
            salesService: $salesService
        );
        $response = $commandHandler->handle($product);

        $this->assertTrue($response->isAdded);

        $cart = $this->cartRepository->findByUserId($userId);
        $this->assertNotNull($cart);

        $items = $cart->items();
        $this->assertCount(1, $items);
//        dd($items);
        $item = $items[0];
        $originalProduct = $this->repository->ofId($productId);
        $expectedDiscountedPrice = $originalProduct->getDiscountedPrice();

//        $this->assertEquals($expectedDiscountedPrice, $cart->calculateTotalPrice());
    }

    private function buildSUT(): void
    {
        $leDjoorProduct1 = new Product(
            'djoor-123',
            'Chemise Le Djoor',
            100.0,
            20,
            'Vêtements',
            'Le Djoor'
        );

        $leDjoorProduct2 = new Product(
            'djoor-456',
            'Pantalon Le Djoor',
            150.0,
            15,
            'Vêtements',
            'Le Djoor'
        );

        $otherProduct = new Product(
            'other-789',
            'T-shirt autre marque',
            50.0,
            30,
            'Vêtements',
            'Autre Marque'
        );

        $this->repository->products['djoor-123'] = $leDjoorProduct1;
        $this->repository->products['djoor-456'] = $leDjoorProduct2;
        $this->repository->products['other-789'] = $otherProduct;
    }
}
