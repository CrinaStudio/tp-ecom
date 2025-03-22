<?php

namespace Src\User\Domain\Vo;

use Src\Shared\Domain\Exceptions\NotEmptyException;
use Src\User\Domain\Hasher;

class Password
{
    private static bool $isFromAdapter = false;

    private string $value;

    private ?Hasher $hasher;

    public function __construct(string $value, ?Hasher $hasher = null)
    {
        $this->value = $value;
        $this->hasher = $hasher;
    }

    public static function fromAdapter(string $password): Password
    {
        $self = new self($password);
        self::$isFromAdapter = true;

        return $self;
    }

    /**
     * @throws NotEmptyException
     */
    public function hash(): string
    {
        if (empty($this->value)) {
            throw new NotEmptyException('this value cannot be empty !');
        }

        if (self::$isFromAdapter) {
            return $this->value;
        }

        if (is_null($this->hasher)) {
            throw new NotEmptyException('Illicit hasher !');
        }

        return $this->hasher->hash($this->value);
    }
}
