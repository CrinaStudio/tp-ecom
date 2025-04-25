<?php

namespace Src\Payment\Domain;

class PaymentResult
{
    public function __construct(
        private string $transactionId,
        private string $status,
        private \DateTimeImmutable $date,
        private float $amount,
        private string $paymentMethod
    ) {}
}
