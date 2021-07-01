<?php
declare(strict_types=1);
/**
 * Domain Test
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\Constraint;

use DateInterval;
use DatePeriod;
use DateTime;
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\Constraint\WeekDays;
use Ticaje\BookingApi\Domain\Signatures\PeriodSignature;
use Ticaje\BookingApi\Domain\Signatures\WeekDaysSignature;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\ComplexConstructor;

/**
 * Class WeekDays
 * @package Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\Constraint
 */
class WeekDaysTest extends ParentClass
{
    use ComplexConstructor;

    protected $interface = WeekDaysSignature::class;

    protected $class = WeekDays::class;

    public function testExtract()
    {
        $expected = (
        new DatePeriod(
            new DateTime(),
            new DateInterval('P1D'),
            (new DateTime())->modify('next monday')
        ));
        $this->instance->method('extract')->willReturn($expected);
        $dataArgument = [
            'from' => (new DateTime())->format(PeriodSignature::DEFAULT_FORMAT),
            'to'   => (new DateTime())->modify('next monday')->format(PeriodSignature::DEFAULT_FORMAT),
        ];
        $methodCallResponse = $this->instance->extract($dataArgument);
        $this->assertTrue(is_array($dataArgument));
        $this->assertInstanceOf(DatePeriod::class, $methodCallResponse, 'Assert returns DatePeriod type');
    }
}
