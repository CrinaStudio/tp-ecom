<?php

namespace Src\Panier\Application\Command;

use Src\Panier\Application\Command\Sales\SalesServiceCommand;
use Src\Panier\Domain\Cart;
use Src\Panier\Domain\Exceptions\LowStockException;
use Src\Panier\Domain\Exceptions\ProductNotFoundException;
use Src\Panier\Domain\Repository\CartRepository;
use Src\Panier\Domain\Repository\ProductRepository;

readonly class AddProductToCardHandle
{
    public function __construct(
        private readonly ProductRepository $repository,
        private readonly CartRepository $cartRepository,
        private readonly ?SalesServiceCommand $salesService = null
    ) {}

    public function handle(SendProductCommand $command): AddProductToCardResponse
    {
        $response = new AddProductToCardResponse;

        $product = $this->repository->ofId($command->productId);
        $cart = $this->cartRepository->findByUserId($command->userId);

        if (! $product) {
            throw new ProductNotFoundException('Produit non trouvé');
        }

        if ($this->salesService !== null) {
            $this->salesService->applyDiscountToProduct($product);
        }

        if (! $cart) {
            try {
                $cart = Cart::create(
                    userId: $command->userId,
                    productId: $command->productId,
                    quantity: $command->quantity,
                    product: $product
                );
            } catch (LowStockException $e) {
                $response->isAdded = false;
                $response->message = $e->getMessage();

                return $response;
            }
        } else {
            $cart->addItem(productId: $command->productId, quantity: $command->quantity, product: $product);
        }

        $this->cartRepository->save($cart);

        $response->isAdded = true;
        $response->cartId = $cart->id();
        $response->message = 'Produit ajouté au panier avec succès';

        return $response;
    }
}
