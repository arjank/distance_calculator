<?php
declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Calculator;
use App\Model\Distance;
use App\Model\DistanceConverter;
use App\Model\Units;
use PHPUnit\Framework\TestCase;

/**
 * Class CalculatorTest
 * @package App\Tests\Model
 * 
 * @coversDefaultClass \App\Model\Calculator
 * @covers ::__construct
 * @covers ::<!public>
 *
 * @uses \App\Model\Distance
 * @uses \App\Model\DistanceConverter
 */
class CalculatorTest extends TestCase
{
    private DistanceConverter $converter;
    private Calculator $calculator;

    public function setUp()
    {
        $this->converter = new DistanceConverter();
        $this->calculator = new Calculator($this->converter);
    }

    /**
     * @param Distance $expected
     * @param Distance $distance1
     * @param Distance $distance2
     *
     * @dataProvider sameDistanceUnitDataProvider
     */
    public function testCalculatorSumsDistancesWithSameUnit(Distance $expected, Distance $distance1, Distance $distance2)
    {
        $actual = $this->calculator->add($expected->getUnit(), $distance1, $distance2);

        self::assertSame($expected->getUnit(), $actual->getUnit());
        self::assertSame($expected->getAmount(), $actual->getAmount());
    }

    /**
     * @param Distance $expected
     * @param Distance $distance1
     * @param Distance $distance2
     *
     * @dataProvider differentDistanceUnitDataProvider
     */
    public function testCalculatorSumsDistancesWithDifferentUnits(Distance $expected, Distance $distance1, Distance $distance2)
    {
        $actual = $this->calculator->add($expected->getUnit(), $distance1, $distance2);

        self::assertSame($expected->getUnit(), $actual->getUnit());
        self::assertEqualsWithDelta($expected->getAmount(), $actual->getAmount(), 0.0001);
    }

    public function testCalculatorSumsThreeDistancesCorrectly()
    {
        $distance1 = new Distance(2, Units::METER);
        $distance2 = new Distance(2, Units::METER);
        $distance3 = new Distance(2, Units::METER);

        $expected = new Distance(6, Units::METER);

        $actual = $this->calculator->add(Units::METER, $distance1, $distance2, $distance3);

        self::assertEquals($expected, $actual);
    }

    public function sameDistanceUnitDataProvider()
    {
        return [
            [new Distance(2, Units::METER), new Distance(1, Units::METER), new Distance(1, Units::METER)],
            [new Distance(5, Units::METER), new Distance(2, Units::METER), new Distance(3, Units::METER)],
            [new Distance(2, Units::YARD), new Distance(1, Units::YARD), new Distance(1, Units::YARD)],
            [new Distance(8, Units::YARD), new Distance(3, Units::YARD), new Distance(5, Units::YARD)],
        ];
    }

    public function differentDistanceUnitDataProvider()
    {
        return [
            [new Distance(1.9144, Units::METER), new Distance(1, Units::METER), new Distance(1, Units::YARD)],
            [new Distance(2.0936, Units::YARD), new Distance(1, Units::METER), new Distance(1, Units::YARD)],
            [new Distance(7.7432, Units::METER), new Distance(3, Units::YARD), new Distance(5, Units::METER)],
            [new Distance(7.3152, Units::METER), new Distance(3, Units::YARD), new Distance(5, Units::YARD)],
            [new Distance(8.7489, Units::YARD), new Distance(3, Units::METER), new Distance(5, Units::METER)],
        ];
    }
}
