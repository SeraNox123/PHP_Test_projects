<?php

session_start();
require "../../../vendor/autoload.php";

if (!isset($_SESSION['sellers'])) {
    echo "Продавцы не добавлены";
    exit();
}

if (isset($_REQUEST['s'])) {
    $s = $_REQUEST["s"];

    if ($s !== "") {
        foreach ($_SESSION['sellers'] as $seller) {
            $seller = unserialize($seller);
            $sellerString = $seller->getName() . ", " . $seller->getAddress();
            /*if ($sellerString == $s) {
                $productsAmount = $seller->getProductsAmount();
                if ($productsAmount < 1) {
                    echo "Товары не найдены";
                } else {
                    $count = 0;
                    $array = $seller->getAllProducts();
                    while ($productsAmount != $count) {
                        echo $array[$count][0]->getName() . ", ";
                        echo $array[$count][1] . ";";
                        $count++;
                    }
                }
                exit();
            } */
        }
    }
}


foreach ($_SESSION['sellers'] as $seller) {
    $seller = unserialize($seller);
    echo "Имя: " . $seller->getName() . "<br>";
    echo "Адрес: " . $seller->getAddress() . "<br><br>";
    //$productsAmount = $seller->getProductsAmount();
    /*if ($productsAmount < 1) {
        echo "Товары не найдены <br><br>";
    } else {
        echo "Товары: <br>";
        $count = 0;
        $array = $seller->getAllProducts();
        while ($productsAmount != $count) {
            echo "Наименование товара: " . $array[$count][0]->getName() . "<br>";
            echo "Количество: " . $array[$count][1] . "<br><br>";
            $count++;
        }
    }*/
}