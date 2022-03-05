<?php

namespace Cart\Item;

use Cart\Contract\ItemPriceInterface;

class ItemWithComboPrice extends ItemWithUnitPrice implements ItemPriceInterface
{
    const COMBO_OFFER_ITEM = 'A';
    protected $itemName;
    protected $price;
    /**
     * __construct function
     *
     * @param string $itemName
     * @param array $items
     */
    public function __construct(string $itemName, array $items)
    {
        $this->itemName  = $itemName;
        $this->items = $items;
    }

    /**
     * calculatePrice function
     *
     * @param array $item
     *
     * @return int
     */
    public function calculatePrice(array $item)
    {

        $itemAQuantity = $this->getItemQuantity(self::COMBO_OFFER_ITEM);
        $itemDQuantity = $item['quantity'];
        $unitPrice = $item['price'];
        $specialPrice = $this->getSpecialPrice($item);

        if ($itemAQuantity >= $itemDQuantity) {
            return round($itemDQuantity * $specialPrice, 2);
        }

        if ($itemDQuantity > 0 && $itemDQuantity > $itemAQuantity) {
            $remainingDQuantity = $itemDQuantity - $itemAQuantity;
            return round(($itemAQuantity * $specialPrice) + ($remainingDQuantity * $unitPrice), 2);
        }

        return 0;
    }

    public function getItemQuantity(string $item)
    {
        return $this->items[$item]['quantity'] ?? 0;
    }

    public function getSpecialPrice(array $item){
        $specialPrice = 0;
        if (isset($item['offer'])) {
            foreach ($item['offer'] as $specialOffer) {
                $specialPrice = (int) $specialOffer['price'];
            }
        }
        return $specialPrice;
    }
}
