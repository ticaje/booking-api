<?php
declare(strict_types=1);
/**
 * Domain Test
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\Constraint;

use TypeError;
use DatePeriod;
use DateInterval;
use DateTimeImmutable;
use ArgumentCountError;
use Ticaje\BookingApi\Domain\Signatures\PeriodSignature;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\Constraint\Period;

/**
 * Class PeriodTest
 * @package Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\Constraint
 */
class PeriodTest extends ParentClass
{
    protected $interface = PeriodSignature::class;

    protected $class = Period::class;

    /**
     * @test
     * @dataProvider validArguments
     */
    public function extract($expected, $arguments)
    {
        $result = $this->instance->extract($arguments);
        $this->assertTrue(is_array($arguments));
        $this->assertEquals($expected, $result);
        $this->assertInstanceOf(DatePeriod::class, $result, 'Assert returns DatePeriod type');
    }

    /**
     * @test
     * @dataProvider validArguments
     */
    public function extractWrongFromArgument($expected, $arguments)
    {
        $this->expectException(TypeError::class);
        $arguments['from'] = null;
        $methodCallResponse = $this->instance->extract($arguments);
        $this->assertInstanceOf(DatePeriod::class, $methodCallResponse, 'Assert returns DatePeriod type');
    }

    /**
     * @test
     */
    public function extractMissingArgument()
    {
        $this->expectException(ArgumentCountError::class);
        $methodCallResponse = $this->instance->extract();
        $this->assertInstanceOf(DatePeriod::class, $methodCallResponse, 'Assert returns DatePeriod type');
    }

    /**
     * Summary of validArguments
     * @return array<array>
     */
    public function validArguments()
    {
        $from = (new DateTimeImmutable())->format(PeriodSignature::DEFAULT_FORMAT);
        $to = (new DateTimeImmutable())->modify('1 months')->format(PeriodSignature::DEFAULT_FORMAT);
        $interval = new DateInterval('P1D');

        $expected = (
            new DatePeriod(
                new DateTimeImmutable($from),
                $interval,
                (new DateTimeImmutable($to))
            )
        );

        $arguments = [
            'from' => $from,
            'to' => $to,
        ];

        return [
            [
                $expected,
                $arguments
            ],
            [
                $expected,
                $arguments
            ]
        ];
    }
}
