<?php

namespace Cart\Exception;

final class ItemNotFoundException extends \RuntimeException
{
    public static function itemName(string $itemName): self
    {
        return new self(sprintf('The item "%s" is not found', $itemName));
    }
}
