<?php
declare(strict_types=1);
/**
 * Domain Test
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\CQRS;

use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS\Command;
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS\CommandSignature;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\ComplexConstructor;

/**
 * Class CommandTest
 * @package Ticaje\BookingApi\Test\Unit\Domain\Calendar\Disabling\CQRS
 */
class CommandTest extends ParentClass
{
    use ComplexConstructor;

    protected $interface = CommandSignature::class;

    protected $class = Command::class;

    public function testExtractType()
    {
        $expected = [];
        $this->instance->method('extractType')->willReturn($expected);
        $methodCallResponse = $this->instance->extractType([]);
        $this->assertTrue(is_array($methodCallResponse), 'Assert returns array');
        $this->assertTrue(empty($methodCallResponse), 'Result is empty');
    }
}
