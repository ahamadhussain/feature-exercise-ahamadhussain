<?php


use PHPUnit\Framework\TestCase;
use Cart\Item\ItemWithUnitPrice;
use Cart\Supermarket\Checkout;
use Cart\Factory\ItemPriceFactory;

class SupermarketTest extends TestCase
{
    public function testCalculateTotalPrice()
    {
        $order = array(
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

        $itemPriceFactory = $this->createMock(ItemPriceFactory::class);
        $discount = $this->createMock(ItemWithUnitPrice::class);
        $discount->method('calculatePrice')->willReturn(100);
        $itemPriceFactory->method('getInstance')->willReturn($discount);

        $checkout = new Checkout($itemPriceFactory, $order);

        $price = $checkout->calculateTotalPrice();
        $this->assertEquals($price, 500);
    }

    public function testCalculatePriceWithInvalidItemName()
    {
        try {
            $order = array(
                'Z' => array(
                    'quantity' => 3,
                    'price' => 5
                )
            );

            $itemPriceFactory = $this->createMock(ItemPriceFactory::class);
            $discount = $this->createMock(ItemWithUnitPrice::class);
            $discount->method('calculatePrice')->willReturn(100);
            $itemPriceFactory->method('getInstance')->willReturn($discount);

            $checkout = new Checkout($itemPriceFactory, $order);

            $price = $checkout->calculateTotalPrice();
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }

        $this->assertEquals($message, 'The item "Z" is not found');
    }
}
