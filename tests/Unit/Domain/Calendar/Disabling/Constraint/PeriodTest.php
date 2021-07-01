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
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\Constraint\Period;
use Ticaje\BookingApi\Domain\Signatures\PeriodSignature;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\ComplexConstructor;

/**
 * Class PeriodTest
 * @package Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\Constraint
 */
class PeriodTest extends ParentClass
{
    use ComplexConstructor;

    protected $interface = PeriodSignature::class;

    protected $class = Period::class;

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
