<?php

require 'vendor\autoload.php';

use Cart\Supermarket\Checkout;
use Cart\Factory\ItemPriceFactory;

$cartItems = array(
    'A' => array(
        'quantity' => 1,
        'price' => 50,
        'offer' => array(['unit' => 3, 'price' => 130])
    ),
    'B' => array(
        'quantity' => 3,
        'price' => 30,
        'offer' => array(['unit' => 2, 'price' => 45])
    ),
    'C' => array(
        'quantity' => 6,
        'price' => 20,
        'offer' => array(['unit' => 2, 'price' => 38], ['unit' => 3, 'price' => 50])
    ),
    'D' => array(
        'quantity' => 2,
        'price' => 15,
        'offer' => array(['price' => 5, 'buy' => 'A'])
    ),
    'E' => array(
        'quantity' => 3,
        'price' => 5
    )
);
$itemPriceFactory = new ItemPriceFactory;
$checkout    = new Checkout($itemPriceFactory, $cartItems);
echo " Total Price: " . $checkout->calculateTotalPrice();
