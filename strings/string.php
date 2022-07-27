<?php
const ENTRY = "the";
$string = "SMS Oldenburg was the fourth vessel of the Helgoland class of battleships of the Imperial German Navy.";
$pos = find_entry($string, 2);
$new_string = delete_entry($string, $pos);
if ($new_string === "Not found") {
    exit();
}
print_string($string);
echo "<br>";
print_string($new_string);

function find_entry($string, $number_of_entry)
{
    for ($i = 0, $offset = 0; $i < $number_of_entry; $i++) {
        // следующий offset будет начинаться с позиции найденного вхождения
        $offset = strpos($string, ENTRY, $offset + 1);
    }
    return $offset; // возвращаем первый символ нужного вхождения
}

function delete_entry($string, $pos)
{
    if ($pos === false) {
        echo "The string " . ENTRY . " was not found in the string '$string'";
        echo "<br>";
        return "Not found";
    } else {
        return substr_replace($string, "", $pos, strlen(ENTRY));
    }
}

function print_string($string)
{
    echo "Строка: " . $string;
}