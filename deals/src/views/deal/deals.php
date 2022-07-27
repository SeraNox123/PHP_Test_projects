<?php

session_start();

require "../../../vendor/autoload.php";

if (!isset($_SESSION['deals'])) {
    echo "Сделки не добавлены";
    exit();
}

$sum = 0;
foreach ($_SESSION['deals'] as $deal) {
    $deal = unserialize($deal);
    echo "Дата: " . $deal->getDate() . "<br>";
    echo "Продавец: " . $deal->getSeller()->getName() . "<br>";
    echo "Покупатель: " . $deal->getBuyer()->getName() . "<br>";
    $count = 0;

    while (count($deal->getProductAndAmount()) != $count) {
        echo "Товар: " . $deal->getProductAndAmount()[$count][0]->getName() . "<br>";
        echo "Цена: " . $deal->getProductAndAmount()[$count][0]->getPrice() . "<br>";
        echo "Количество: " . $deal->getProductAndAmount()[$count][1] . "<br>";
        echo "Сумма: " . $deal->getProductAndAmount()[$count][0]->getCost(
                ($deal->getProductAndAmount()[$count][1])
            ) . "<br><br>";
        $count++;
    }
    echo "Сумма всей сделки: " . $deal->getTotalSum() . "<br><br>";
    echo "<br>";
}
