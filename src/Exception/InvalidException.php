<?php

namespace Cart\Exception;

final class InvalidException extends \RuntimeException
{
    public static function invalidQuantity(): self
    {
        return new self('The given quantity is invalid');
    }
}
