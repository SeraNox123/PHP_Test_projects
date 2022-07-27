<?php

namespace App\Product;

class Camera extends Product
{
    private bool $digital;
    private int $megapixelCount;
    private const NON_DIGITAL_DISCOUNT = 20;

    /**
     * @return int
     */
    public function getMegapixelCount(): int
    {
        return $this->megapixelCount;
    }

    /**
     * @param int $megapixelCount
     */
    public function setMegapixelCount(int $megapixelCount): void
    {
        $this->megapixelCount = $megapixelCount;
    }

    /**
     * @return bool
     */
    public function isDigital(): bool
    {
        return $this->digital;
    }

    /**
     * @param bool $digital
     */
    public function setDigital(bool $digital): void
    {
        $this->digital = $digital;
    }

    protected function calcDiscount(int $amount): int
    {
        $discount = parent::calcDiscount($amount);
        if (!$this->isDigital()) {
            $discount += self::NON_DIGITAL_DISCOUNT;
        }
        return $discount;
    }
}