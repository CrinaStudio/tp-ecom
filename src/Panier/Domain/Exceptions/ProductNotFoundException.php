<?php

namespace Src\Panier\Domain\Exceptions;

class ProductNotFoundException extends \Exception
{

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
    }
}
