<?php
session_start();
require "../../../vendor/autoload.php";

if (!isset($_SESSION['buyers'])) {
    echo "Покупатели не добавлены";
    exit();
}

foreach ($_SESSION['buyers'] as $buyer) {
    $buyer = unserialize($buyer);
    echo "Имя: " . $buyer->getName() . "<br>";
    echo "Адрес: " . $buyer->getAddress() . "<br><br>";
}