<?php

namespace Src\Payment\Domain\Repository;

use Src\Panier\Domain\Cart;
use Src\Payment\Domain\PaymentResult;

interface PaymentMethodRepository
{
    public function processPayment(Cart $cart, float $amount): PaymentResult;
    public function getName(): string;
    public function getType(): string;
}
