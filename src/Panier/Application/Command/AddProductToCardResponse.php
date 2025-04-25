<?php

namespace Src\Panier\Application\Command;

class AddProductToCardResponse
{
    public bool $isAdded = false;

    public string $cartId;

    public string $message;
}
