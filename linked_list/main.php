<?php
require_once "LinkedList.php";

/**
 * @param LinkedList $list
 * @return void
 */
function printList(LinkedList $list)
{
    try {
        $temp = $list->getHead();
    } catch (Exception $e) {
        echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        return;
    }
    if ($temp != null) {
        echo "\nThe list contains: ";
        while ($temp != null) {
            echo $temp->data . " ";
            $temp = $temp->next;
        }
    } else {
        echo "\nThe list is empty";
    }
}

$list = new LinkedList();
$list->pushBack(2);
$list->pushBack(3);
$list->pushBack(10);

printList($list);
echo "<br>";
echo "Количество элементов: ", $list->count();
echo "<br>";
if ($list->isEmpty()) {
    echo "Список 1 пуст";
} else {
    echo "Список 1 непуст";
}
echo "<br>";

try {
    $temp = $list->offsetGet(2);
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
    return;
}

echo "Значение: ", $temp, "<br>";

$list->clear();
try {
    $temp = $list->bottom();
    echo "Первый элемент: ", $temp, "<br>";
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "\n";
    return;
}