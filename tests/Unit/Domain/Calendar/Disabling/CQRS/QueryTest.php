<?php
declare(strict_types=1);
/**
 * Domain Test
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\CQRS;

use DateTime;
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS\Query;
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS\QuerySignature;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\ComplexConstructor;

/**
 * Class QueryTest
 * @package Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\CQRS
 */
class QueryTest extends ParentClass
{
    use ComplexConstructor;

    protected $interface = QuerySignature::class;

    protected $class = Query::class;

    public function testFetchList()
    {
        $expected = [];
        $this->instance->method('fetchList')->willReturn($expected);
        $methodCallResponse = $this->instance->fetchList();
        $this->assertTrue(is_array($methodCallResponse), 'Assert returns array type');
    }

    public function testInterpret()
    {
        $expected = $this->instance;
        $this->instance->method('interpret')->willReturn($expected);
        $methodCallResponse = $this->instance->interpret(json_encode(['from' => new DateTime(), 'to' => new DateTime()]), 'single');
        $this->assertInstanceOf(QuerySignature::class, $methodCallResponse, 'Assert returns itself');
    }
}
