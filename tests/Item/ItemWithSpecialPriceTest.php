<?php

use PHPUnit\Framework\TestCase;
use Cart\Item\ItemWithSpecialPrice;

class ItemWithSpecialPriceTest extends TestCase 
{
    public function testCalculatePrice() {
        $data = ['price'=> 50,'quantity'=> 6];
        $discount = new ItemWithSpecialPrice('A', $data);
        $discount->setSpecialPrice(3, 30);
        $price = $discount->calculatePrice($data);
        $this->assertEquals(60, $price);
    }

    public function testCalculatePriceWithDecimalValues() {
        $data = ['price'=> 50.5500,'quantity'=> 7];
        $discount = new ItemWithSpecialPrice('A', $data);
        $discount->setSpecialPrice(3, 30);
        $price = $discount->calculatePrice($data);
        $this->assertEquals(110.55, $price);
    }
}