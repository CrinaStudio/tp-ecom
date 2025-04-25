<?php

namespace Src\Payment\Domain\Repository;

use Src\Payment\Domain\PaymentResult;

interface PaymentRepository
{
    public function save(PaymentResult $paymentResult): void;
    public function findByType(string $paymentType): array;
    public function findAll(): array;
}
