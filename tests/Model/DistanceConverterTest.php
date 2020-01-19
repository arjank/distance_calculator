<?php
declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Distance;
use App\Model\DistanceConverter;
use App\Model\Units;
use PHPUnit\Framework\TestCase;

/**
 * Class DistanceConverterTest
 * @package App\Tests\Model
 *
 * @coversDefaultClass \App\Model\DistanceConverter
 * @covers ::<!public>
 * @covers ::convert
 *
 * @uses \App\Model\Distance
 */
class DistanceConverterTest extends TestCase
{
    private DistanceConverter $converter;

    protected function setUp()
    {
        $this->converter = new DistanceConverter();
    }

    /**
     * @param Distance $distance
     * @param string $outputUnit
     *
     * @dataProvider sameUnitDataProvider
     */
    public function testConverterReturnsWithoutConversionIfSameUnitRequested(Distance $distance, string $outputUnit)
    {
        $expected = $distance;
        $actual = $this->converter->convert($distance, $outputUnit);

        self::assertSame($expected, $actual);
    }

    /**
     * @param Distance $distance
     * @param string $outputUnit
     * @param float $expectedAmount
     *
     * @dataProvider differentUnitDataProvider
     */
    public function testConverterConvertsYardsAndMetersCorrectly(Distance $distance, string $outputUnit, float $expectedAmount)
    {
        $actual = $this->converter->convert($distance, $outputUnit)->getAmount();

        self::assertEqualsWithDelta($expectedAmount, $actual, 0.0001);
    }

    public function sameUnitDataProvider()
    {
        return [
            [new Distance(1, Units::METER), Units::METER],
            [new Distance(5, Units::YARD), Units::YARD],
        ];
    }

    public function differentUnitDataProvider()
    {
        return [
            [new Distance(1, Units::METER), Units::YARD, 1.0936],
            [new Distance(10, Units::METER), Units::YARD, 10.9361],
            [new Distance(1, Units::YARD), Units::METER, 0.9144],
            [new Distance(10, Units::YARD), Units::METER, 9.1440],
        ];
    }
}
