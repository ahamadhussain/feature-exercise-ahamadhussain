# PHP Task - Supermarket Checkout 

## Problem Description 
    Implemented the code for Supermarket checkout that calculates the total price of number of items with special price.

## Instalation Steps
    - Use `composer install` to install the autoloader and other dependencies.
    - Execute `index.php` file to run the application.


## View the Total price calculation 
    http://localhost/<projectname>

## To verify the more number of output we can modify the quanity under index.php file

    $order = array(
            'A' => array(
                        'quantity' => 7,
                        'price' => 50,
                        'offer' => array(['unit' => 3, 'price' => 130])
                )
            );

## Unit Test Case
    Execute the below commands for unit test case
    
    <projectRepo>vendor\bin\phpunit tests --testdox
    PHPUnit 8.5.23 by Sebastian Bergmann and contributors.

    Item Price Factory
    ✔ Get instance with item with unit price
    ✔ Get instance with item with special price
    ✔ Get instance with item with combo price
    ✔ Get instance with incorrect product type

    Item With Combo Price
    ✔ Calculate price
    ✔ Calculate price with decimal valus

    Item With Special Price
    ✔ Calculate price
    ✔ Calculate price with decimal values

    Item With Unit Price
    ✔ Calculate price
    ✔ Calculate price with decimal values
    ✔ Throw execption for invalid quantity

    Supermarket
    ✔ Calculate total price
    ✔ Calculate price with invalid item name

    Time: 153 ms, Memory: 6.00 MB

    OK (13 tests, 13 assertions)