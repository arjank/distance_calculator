<?php

namespace App\Model;

class Distance
{
    private float $amount;
    private string $unit;

    public function __construct(float $amount, string $unit)
    {
        $this->amount = $amount;
        $this->unit = $unit;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}
