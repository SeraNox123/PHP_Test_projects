<?php

use App\Product\Boots;
use App\Product\Camera;

session_start();
require "../../../vendor/autoload.php";

if (!isset($_SESSION['products'])) {
    echo "Товары не добавлены";
    exit();
}

foreach ($_SESSION['products'] as $product) {
    $product = unserialize($product);
    echo "Наименование товара: " . $product->getName() . "<br>";
    echo "Цена товара: " . $product->getPrice() . "<br>";
    echo "Скидка (%): " . $product->getDiscount() . "<br>";
    if ($product instanceof Boots) {
        echo "Размер обуви: " . $product->getSize() . "<br>";
        echo "Цвет обуви: " . $product->getColor() . "<br><br>";
    } elseif ($product instanceof Camera) {
        if ($product->isDigital()) {
            echo "Цифровой" . "<br>";
        } else {
            echo "Аналоговый" . "<br>";
        }

        echo "Количество мегапикселей: " . $product->getMegapixelCount() . "<br><br>";
    }
}