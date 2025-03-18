<?php

namespace Src\Shared\Domain;

interface IdGenerator
{
    public function generate(): string;
}
