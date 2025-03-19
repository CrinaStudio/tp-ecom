<?php

namespace Src\Shared\Infrastructure\Lib;

use Illuminate\Support\Str;
use Src\Shared\Domain\IdGenerator;

class LaravelIdGenerator implements IdGenerator
{
    public function generate(): string
    {
        return Str::uuid()->toString();
    }
}
