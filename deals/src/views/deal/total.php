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
    $sum += $deal->getTotalSum();
}

echo "Итого по всем сделкам: " . $sum;