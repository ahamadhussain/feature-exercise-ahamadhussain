<?php

namespace Cart\Contract;

interface ItemPriceInterface
{
    /**
     * __construct function
     *
     * @param string $itemName
     * @param array $item
     */
    public function __construct(string $itemName, array $item);

    /**
     * calculatePrice function
     *
     * @param array $item
     *
     * @return array
     */
    public function calculatePrice(array $item);
}
