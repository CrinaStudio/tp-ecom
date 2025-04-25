<?php

namespace Src\Panier\Tests\Unit;

use Src\Panier\Domain\Cart;
use Src\Payment\Domain\PaymentResult;
use Src\Payment\Domain\Repository\PaymentMethodRepository;

class inMemoryCrinaPayPaymentMethod implements PaymentMethodRepository
{
    public function processPayment(Cart $cart, float $amount): PaymentResult
    {
        return new PaymentResult(/*  */);
    }

    public function getName(): string
    {
        return 'CRINA-PAY';
    }

    public function getType(): string
    {
        return 'ELECTRONIC';
    }
}
