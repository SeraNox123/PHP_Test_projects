<?php

interface LList
{
    public function clear(): void;
    public function bottom(): int;
    public function isEmpty(): bool;
    public function pushBack(int $newElement): void;
    public function offsetGet(int $index): int;
    public function count(): int;
}

class Node
{
    /**
     * @var int|null
     */
    public ?int $data;
    /**
     * @var Node|null
     */
    public ?Node $next;
}

class LinkedList implements LList
{
    /**
     * Структура ноды
     * @var Node|null
     */
    private ?Node $head;

    /**
     * Инициализирует головной элемент
     */
    public function __construct()
    {
        $this->head = null;
    }

    /**
     * @return Node|null
     */
    public function getHead(): ?Node
    {
        return $this->head;
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $temp = $this->head;
        while ($temp->next != null) {
            $temp2 = $temp;
            $temp = $temp->next;
            unset($temp2);
        }
        unset($temp);

        $this->head = null;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function bottom(): int
    {
        if ($this->isEmpty()) {
            throw new Exception("Список не проинициализирован");
        }

        return $this->head->data;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->head == null;
    }

    /**
     * Доб
     *
     * @param int $newElement
     * @return void
     */
    public function pushBack(int $newElement): void
    {
        $newNode = new Node();
        $newNode->data = $newElement;
        $newNode->next = null;

        if ($this->isEmpty()) {
            $this->head = $newNode;
        } else {
            $temp = $this->head;
            while ($temp->next != null) {
                $temp = $temp->next;
            }
            $temp->next = $newNode;
        }
    }


    /**
     * @param int $index
     * @return int
     * @throws Exception
     */
    public function offsetGet(int $index): int
    {
        if ($this->isEmpty()) {
            throw new Exception("Список не проинициализирован");
        }

        if ($index < 0 || $index >= $this->count()) {
            throw new OutOfRangeException("Ошибка диапазона");
        }

        $temp = $this->head;
        $i = 0;
        while ($i != $index) {
            $temp = $temp->next;
            $i++;
        }
        return $temp->data;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $itemCount = 0;
        try {
            $temp = $this->head;
        } catch (Exception $e) {
            echo 'Выброшено исключение: ', $e->getMessage(), "\n";
            return 0;
        }
        while ($temp != null) {
            $temp = $temp->next;
            $itemCount++;
        }
        return $itemCount;
    }
}

