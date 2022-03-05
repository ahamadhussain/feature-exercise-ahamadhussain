<?php

namespace Cart\Supermarket;

use Cart\Exception\ItemNotFoundException;
use Cart\Factory\ItemPriceFactory;

class Checkout
{
    const MULTI_OFFER = ['A', 'B', 'C'];
    const COMBO_OFFER = ['D'];
    const NO_OFFER = ['E'];

    private $discounts = [];

    /**
     * __construct function
     *
     * @param ItemPriceFactory $itemPriceFactory
     * @param array $items
     */
    public function __construct(ItemPriceFactory $itemPriceFactory, array $items)
    {
        $this->itemPriceFactory = $itemPriceFactory;
        $this->items = $items;
    }

    /**
     * calcualte Total Price of the item
     *
     * @return int
     */
    public function calculateTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->items as $itemName => $item) {

            if (in_array($itemName, self::NO_OFFER)) {
                $this->discounts[$itemName] = $this->itemPriceFactory->getInstance(ItemPriceFactory::ITEM_WITH_UNIT_PRICE, $itemName, $item);
            } else if (in_array($itemName, self::MULTI_OFFER)) {
                $this->discounts[$itemName] = $this->itemPriceFactory->getInstance(ItemPriceFactory::ITEM_WITH_SPECIAL_PRICE, $itemName, $item);
            } else if (in_array($itemName, self::COMBO_OFFER)) {
                $this->discounts[$itemName] = $this->itemPriceFactory->getInstance(ItemPriceFactory::ITEM_WITH_COMBO_PRICE, $itemName, $this->items);
            } else {
                throw ItemNotFoundException::itemName($itemName);
            }

            $totalPrice += $this->discounts[$itemName]->calculatePrice($item);
        }
        return $totalPrice;
    }
}
