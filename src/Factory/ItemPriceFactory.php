<?php

namespace Cart\Factory;

use Exception;
use Cart\Item\ItemWithUnitPrice;
use Cart\Item\ItemWithSpecialPrice;
use Cart\Item\ItemWithComboPrice;

class ItemPriceFactory
{
    const ITEM_WITH_UNIT_PRICE    = "itemWithUnitPrice";
    const ITEM_WITH_SPECIAL_PRICE = "itemWithSpecialPrice";
    const ITEM_WITH_COMBO_PRICE = "itemWithComboPrice";

    /**
     * getInstance function
     *
     * @param string $discountName
     * @param string $itemName
     * @param array  $item
     *
     * @return Discount
     */
    public function getInstance(string $discountName, string $itemName, array $item)
    {
        if ($discountName === self::ITEM_WITH_UNIT_PRICE) {
            $discount = new ItemWithUnitPrice($itemName, $item);
        } else if ($discountName === self::ITEM_WITH_SPECIAL_PRICE) {
            $discount = new ItemWithSpecialPrice($itemName, $item);
        } else if ($discountName  === self::ITEM_WITH_COMBO_PRICE) {
            $discount = new ItemWithComboPrice($itemName, $item);
        } else {
            throw new Exception("$discountName discount type is not found.");
        }

        return $discount;
    }
}
