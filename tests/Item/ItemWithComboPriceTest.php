<?php

use PHPUnit\Framework\TestCase;
use Cart\Item\ItemWithComboPrice;

class ItemWithComboPriceTest extends TestCase 
{
    public function testCalculatePrice() {
        $order = array(
            'A' => array(
                'quantity' => 6,
                'price' => 50,
                'offer' => array(['unit' => 3, 'price' => 130])
            ),
            'D' => array(
                'quantity' => 10,
                'price' => 15,
                'offer' => array(['price' => 5, 'buy' => 'A'])
            ),
            'E' => array(
                'quantity' => 3,
                'price' => 5
            )
        );
        $disocunt = new ItemWithComboPrice('A', $order);
        $price = $disocunt->calculatePrice($order['D']);
        $this->assertEquals(90, $price);
    }

    public function testCalculatePriceWithDecimalValus() {
        $order = array(
            'A' => array(
                'quantity' => 3,
                'price' => 50.75,
                'offer' => array(['unit' => 3, 'price' => 130])
            ),
            'D' => array(
                'quantity' => 10,
                'price' => 15.25,
                'offer' => array(['price' => 5, 'sku' => 'A'])
            ),
            'E' => array(
                'quantity' => 3,
                'price' => 5
            )
        );
        $disocunt = new ItemWithComboPrice('A', $order);
        $price = $disocunt->calculatePrice($order['D']);
        $this->assertEquals(121.75, $price);
    }
}