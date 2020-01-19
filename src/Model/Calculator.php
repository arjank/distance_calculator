<?php
declare(strict_types=1);

namespace App\Model;

class Calculator
{
    private DistanceConverter $distanceConverter;

    public function __construct(DistanceConverter $distanceConverter)
    {
        $this->distanceConverter = $distanceConverter;
    }

    public function add(string $outputUnit, Distance ...$distances): Distance
    {
        $convertedAmounts = array_map(
            fn($d) => $this->distanceConverter->convert($d, $outputUnit)->getAmount(),
            $distances
        );

        return new Distance(array_sum($convertedAmounts), $outputUnit);
    }
}
