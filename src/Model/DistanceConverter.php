<?php
declare(strict_types=1);

namespace App\Model;

use InvalidArgumentException;

class DistanceConverter
{
    const YARDS_TO_METERS = 1.09361;

    public function convert(Distance $distance, string $outputUnit): Distance
    {
        if ($distance->getUnit() === $outputUnit) {
            return $distance;
        }

        switch ($outputUnit) {
            case Units::YARD:
                return $this->convertToYards($distance);
                break;
            case Units::METER:
                return $this->convertToMeters($distance);
                break;
            default:
                throw new InvalidArgumentException('Unsupported unit found for conversion');
        }
    }

    private function convertToYards(Distance $distance)
    {
        switch ($distance->getUnit()) {
            case Units::METER:
                return new Distance($distance->getAmount() * self::YARDS_TO_METERS, Units::YARD);
                break;
            default:
                throw new InvalidArgumentException('Unsupported unit found for conversion');
        }
    }

    private function convertToMeters(Distance $distance)
    {
        switch ($distance->getUnit()) {
            case Units::YARD:
                return new Distance($distance->getAmount() / self::YARDS_TO_METERS, Units::METER);
                break;
            default:
                throw new InvalidArgumentException('Unsupported unit found for conversion');
        }
    }
}
