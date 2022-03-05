<?php

namespace Cart\Item;

use Cart\Contract\ItemPriceInterface;
use Cart\Exception\InvalidException;

class ItemWithUnitPrice implements ItemPriceInterface
{
    protected $itemName;
    protected $price;

    /**
     * __construct function
     *
     * @param string $itemName
     * @param array $item
     */
    public function __construct(string $itemName, array $item)
    {
        if ($item['quantity'] < 0) {
            throw InvalidException::invalidQuantity();
        }
        $this->itemName  = $itemName;
        $this->price = $item['price'];
    }

    /**
     * calculatePrice function
     *
     * @param array $item
     *
     * @return float
     */
    public function calculatePrice(array $item)
    {
        return round($item['quantity'] * $this->price, 2);
    }
}
