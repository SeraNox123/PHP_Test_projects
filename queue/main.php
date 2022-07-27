<?php
// создание
// добавление трёх элементов
// получение с удалением одного элемента
// добавляем ещё три элемента, использовать try..catch
require_once "Queue.php";

function printQueue(Queue $queue)
{
    while (!$queue->isEmpty()) {
        try {
            echo $queue->dequeue(), " ";
        } catch (Exception $empty) {
            echo 'Выброшено исключение: ', $empty->getMessage(), "<br>";
            return;
        }
    }
}

try {
    $queue = new Queue(5);
    $queue->enqueue(10);
    $queue->enqueue(20);
    $queue->enqueue(30);
    $queue->dequeue();
    $queue->enqueue(40);
    $queue->enqueue(50);
    $queue->enqueue(60);
    //$queue->enqueue(5);
} catch (Exception $e) {
    echo 'Выброшено исключение: ', $e->getMessage(), "<br>";
    return;
}

//printQueue($queue);
echo "<br>Количество элементов: ", $queue->count(), "<br>";

//$queue->clear();

