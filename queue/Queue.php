<?php

class Queue
{
    private SplFixedArray $array;
    private int $index; // указывает на свободную ячейку справа

    /**
     * @throws Exception
     */
    public function __construct(int $size)
    {
        if ($size <= 0) {
            throw new Exception("Ошибка: размер очереди должен быть больше 0");
        }
        $this->array = new SplFixedArray($size);
        $this->index = 0;
    }

    public function clear(): void
    {
        unset($this->array);
        $this->index = 0;
    }

    public function enqueue(int $number): void
    {
        if ($this->index == $this->array->getSize()) {
            throw new OutOfRangeException("Ошибка: очередь переполнена.");
        }
        $this->array->offsetSet($this->index, $number);
        $this->index++;
    }

    /**
     * @throws Exception
     */
    public function dequeue(): int
    {
        // достаёт всегда нулевой элемент, нужно сдвигать остальные элементы на один влево
        // самый правый элемент после dequeue - null
        if (!$this->isEmpty()) {
            $value = $this->array->offsetGet(0);
            $this->array->offsetUnset(0);

            // смещаем элементы
            for ($i = 0; $i < $this->count() - 1; $i++) {
                $this->array->offsetSet($i, $this->array->offsetGet($i + 1));
            }
        } else {
            throw new Exception("Ошибка: очередь пуста");
        }

        $this->index--;
        return $value;
    }

    public function isEmpty(): bool
    {
        return $this->index == 0;
    }

    public function count(): int
    {
        return $this->index;
    }

}