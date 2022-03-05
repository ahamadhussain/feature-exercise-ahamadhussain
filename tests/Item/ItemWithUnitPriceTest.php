<?php

use PHPUnit\Framework\TestCase;
use Cart\Item\ItemWithUnitPrice;

class ItemWithUnitPriceTest extends TestCase
{
    public function testCalculatePrice()
    {
        $discount = new ItemWithUnitPrice('E', ['price' => 5, 'quantity' => 3]);
        $price = $discount->calculatePrice(['quantity' => 3]);
        $this->assertEquals(15, $price);
    }
    public function testCalculatePriceWithDecimalValues()
    {
        $discount = new ItemWithUnitPrice('E', ['price' => 5.75, 'quantity' => 3]);
        $price = $discount->calculatePrice(['quantity' => 3]);
        $this->assertEquals(17.25, $price);
    }

    public function testThrowExecptionForInvalidQuantity()
    {
        try {
            $discount = new ItemWithUnitPrice('E', ['price' => 5, 'quantity' => -1]);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }
        $this->assertEquals($message, 'The given quantity is invalid');
    }
}
