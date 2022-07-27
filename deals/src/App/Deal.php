<?php

namespace App;

class Deal
{
    private string $date;
    private Participant $buyer;
    private Participant $seller;
    private array $productAndAmount;
    private float $totalSum;

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return Participant
     */
    public function getBuyer(): Participant
    {
        return $this->buyer;
    }

    /**
     * @param Participant $buyer
     */
    public function setBuyer(Participant $buyer): void
    {
        $this->buyer = $buyer;
    }

    /**
     * @return array
     */
    public function getProductAndAmount(): array
    {
        return $this->productAndAmount;
    }

    /**
     * @param array $productAndAmount
     */
    public function setProductAndAmount(array $productAndAmount): void
    {
        $this->productAndAmount = $productAndAmount;
    }

    /**
     * @return Participant
     */
    public function getSeller(): Participant
    {
        return $this->seller;
    }

    /**
     * @param Participant $seller
     */
    public function setSeller(Participant $seller): void
    {
        $this->seller = $seller;
    }

    /**
     * @return float
     */
    public function getTotalSum(): float
    {
        return $this->totalSum;
    }

    /**
     * @param float $totalSum
     */
    public function setTotalSum(float $totalSum): void
    {
        $this->totalSum = $totalSum;
    }
}