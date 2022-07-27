<?php
require_once __DIR__ . '/array.php';
$original_array = array();
for ($i = 0; $i < 4; $i++) {
    fill_array($original_array[$i], 5);
}
print_matrix($original_array);
echo "<br>";
$new_array = array_replace([], $original_array); // копия массива
$k = rand(0, 4);
remove_column($new_array, $k);
print_matrix($new_array);
$original_array = print_r($original_array, true);
$new_array = print_r($new_array, true);
output_to_file_new($original_array, $new_array, $k);
echo "<br>";
echo $k;

function remove_column(&$array, $column)
{
    foreach (range(0, count($array) - 1) as $i) {
        unset($array[$i][$column]);
        // optional - re-index the array
        $array[$i] = array_values($array[$i]);
    }
}

function print_matrix($array) {
    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array[$i]); $j++) {
            echo $array[$i][$j] . "\t";
        }
        echo "<br>";
    }
}

function output_to_file_new($originalArray, $newArray, $k)
{
    file_put_contents("output.txt", "Задание 2: удаление k-ого столбца матрицы\n", FILE_APPEND);
    file_put_contents("output.txt", "Оригинальный массив:\n", FILE_APPEND);
    file_put_contents("output.txt", $originalArray, FILE_APPEND);
    file_put_contents("output.txt", "Изменённый массив:\n", FILE_APPEND);
    file_put_contents("output.txt", $newArray, FILE_APPEND);
    file_put_contents("output.txt", "\nУдалён " . $k . " столбец\n", FILE_APPEND);
}