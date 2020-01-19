<?php

namespace App\Tests\Model;

use App\Model\Distance;
use App\Model\Units;
use PHPUnit\Framework\TestCase;

/**
 * Class DistanceTest
 * @package App\Tests\Model
 *
 * @coversDefaultClass \App\Model\Distance
 * @covers ::__construct
 * @covers ::<!public>
 */
class DistanceTest extends TestCase
{
    /**
     * @covers ::getAmount
     * @dataProvider amountDataProvider
     */
    public function testDistanceReturnsGivenAmount(float $amount)
    {
        $distance = new Distance($amount, Units::METER);

        self::assertSame($amount, $distance->getAmount());
    }

    /**
     * @covers ::getUnit
     * @dataProvider unitDataProvider
     */
    public function testDistanceReturnGivenUnit(string $unit)
    {
        $distance = new Distance(1, $unit);

        self::assertSame($unit, $distance->getUnit());
    }

    public function amountDataProvider()
    {
        return [
            [1],
            [2.5],
        ];
    }

    public function unitDataProvider()
    {
        return [
            'meter' => [Units::METER],
            'yard' => [Units::YARD],
        ];
    }
}
