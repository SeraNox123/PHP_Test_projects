<?php
$array = array();
fill_array($array, 5);
$biggest_number = find_biggest_number_abs($array);
$result_array = print_r($array, true);
$result_biggest_number = print_r("Самое большое число по модулю: " . $biggest_number, true);
output_to_file($result_array, $result_biggest_number);
//echo "Скрипт отработал";

function fill_array(array &$array, int $count): void
{
    $i = 0;
    while ($i < $count) {
        $array[] = rand(-10, 10);
        $i++;
    }
    /*    for ($i = 0; $i < $count; $i++) {
            $array[] = rand(-10, 10);
        }
    */
}

function find_biggest_number_abs(array $array): int
{
    $biggest_number = $array[0];
    foreach ($array as $value) {
        if (abs($value) > abs($biggest_number)) {
            $biggest_number = $value;
        }
    }
    unset($value);
    return $biggest_number;
}

function output_to_file(string $array, string $result): void
{
    file_put_contents("output.txt", "Задание 1: поиск максимального по модулю значения в массиве\n", FILE_APPEND);
    file_put_contents("output.txt", $array, FILE_APPEND);
    file_put_contents("output.txt", $result, FILE_APPEND);
    file_put_contents("output.txt", "\n\n", FILE_APPEND);
}