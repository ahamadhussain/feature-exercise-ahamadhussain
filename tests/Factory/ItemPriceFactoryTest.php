<?php

use PHPUnit\Framework\TestCase;
use Cart\Factory\ItemPriceFactory;
use Cart\Item\ItemWithSpecialPrice;
use Cart\Item\ItemWithComboPrice;
use Cart\Item\ItemWithUnitPrice;

class ItemPriceFactoryTest extends TestCase
{
    private $itemPriceFactory;
    public function __construct()
    {
        parent::__construct();
        $this->itemPriceFactory = new ItemPriceFactory;
    }

    public function testGetInstanceWithItemWithUnitPrice()
    {
        $item = ['price' => 50, 'quantity' => 2, 'offer' => array(['unit' => 3, 'price' => 130])];
        $discount = $this->itemPriceFactory->getInstance(ItemPriceFactory::ITEM_WITH_UNIT_PRICE, 'A',  $item);
        $this->assertTrue($discount instanceof ItemWithUnitPrice);
    }

    public function testGetInstanceWithItemWithSpecialPrice()
    {
        $item = ['price' => 30, 'quantity' => 2, 'offer' => array(['unit' => 2, 'price' => 45])];

        $discount = $this->itemPriceFactory->getInstance(ItemPriceFactory::ITEM_WITH_SPECIAL_PRICE, 'B', $item);
        $this->assertTrue($discount instanceof ItemWithSpecialPrice);
    }

    public function testGetInstanceWithItemWithComboPrice()
    {
        $cartItem = array(
            'A' => array(
                'quantity' => 6,
                'price' => 50,
                'offer' => array(['unit' => 3, 'price' => 130])
            ),
            'B' => array(
                'quantity' => 2,
                'price' => 30,
                'offer' => array(['unit' => 2, 'price' => 45])
            ),
            'C' => array(
                'quantity' => 5,
                'price' => 20,
                'offer' => array(['unit' => 2, 'price' => 38], ['unit' => 3, 'price' => 50])
            ),
            'D' => array(
                'quantity' => 3,
                'price' => 15,
                'offer' => array(['price' => 5, 'buy' => 'A'])
            ),
            'E' => array(
                'quantity' => 3,
                'price' => 5
            )
        );

        $discount = $this->itemPriceFactory->getInstance(ItemPriceFactory::ITEM_WITH_COMBO_PRICE, 'D', $cartItem);
        $this->assertTrue($discount instanceof ItemWithComboPrice);
    }

    public function testGetInstanceWithIncorrectProductType()
    {
        $message = '';
        $item = ['price' => 30, 'quantity' => 2, 'offer' => array(['unit' => 2, 'price' => 45])];

        try {
            $this->itemPriceFactory->getInstance("ItemX_Y_Price!", 'C', $item);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }

        $this->assertEquals($message, 'ItemX_Y_Price! discount type is not found.');
    }
}
