<?php

namespace Cart\Item;

use Cart\Contract\ItemPriceInterface;
use Cart\Exception\InvalidException;

class ItemWithSpecialPrice extends ItemWithUnitPrice implements ItemPriceInterface
{
    private $specialPrices = [];
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
        if ($items['quantity'] < 0) {
            throw InvalidException::invalidQuantity();
        }
        $this->itemName  = $itemName;
        $this->items = $items;
    }
    /**
     * setSpecialPrice function
     *
     * @param integer $count
     * @param float $price
     *
     * @return void
     */
    public function setSpecialPrice(int $count, float $price)
    {
        $this->specialPrices[$count] = $price;
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
        $this->applyOffer($item);

        $price = 0;
        $count = $item['quantity'];

        krsort($this->specialPrices);
        foreach ($this->specialPrices as $productCount => $productPrice) {
            if ($count >= $productCount) {
                $price += ((int) ($count / $productCount) * $productPrice);
                $count  = $count % $productCount;
            }
        }

        $price += $count * $this->items['price'];

        return round($price, 2);
    }
    /**
     * applyOffer if exist for an item 
     *
     * @param array $item
     *
     * @return void
     */
    public function applyOffer(array $item)
    {
        if (isset($item['offer'])) {
            foreach ($item['offer'] as $specialOffer) {
                $specialOfferCount = (int) $specialOffer['unit'];
                $specialOfferPrice = (int) $specialOffer['price'];
                $this->setSpecialPrice($specialOfferCount, $specialOfferPrice);
            }
        }
    }
}
