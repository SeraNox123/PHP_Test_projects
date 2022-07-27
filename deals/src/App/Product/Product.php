<?php

namespace App\Product;

abstract class Product
{
    private string $name;
    private float $price;
    private int $discount;
    private const DISCOUNT_PERCENT = 10;
    private const DISCOUNT_ITEMS_COUNT = 5;

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCost(int $amount): float
    {
        $realCost = $amount * $this->price;
        return $realCost - $realCost * $this->calcDiscount($amount) / 100;
    }

    protected function calcDiscount(int $amount): int
    {
        return $amount > self::DISCOUNT_ITEMS_COUNT ? self::DISCOUNT_PERCENT : $this->getDiscount();
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @param int $discount
     */
    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }
}