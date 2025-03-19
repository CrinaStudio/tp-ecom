<?php

namespace Src\Shared\Tests\Unit;

use Src\Shared\Domain\IdGenerator;

class FixedIdGenerator implements IdGenerator
{
    public function generate(): string
    {
        return '001';
    }
}
