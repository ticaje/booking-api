<?php
declare(strict_types=1);
/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Application\Service\Provider\Package;

use Ticaje\BookingApi\Application\Service\Provider\Package\PriceAggregate;
use Ticaje\BookingApi\Application\Signatures\Provider\PriceProviderSignature;
use Ticaje\BookingApi\Application\Signatures\UseCase\Command\GetPriceCommandSignature;
use Ticaje\BookingApi\Application\UseCase\Command\GetPriceCommand;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\ComplexConstructor;

/**
 * Class PriceTest
 * @package Ticaje\BookingApi\Test\Unit\Application\Service\Provider
 */
class PriceTest extends ParentClass
{
    use ComplexConstructor;

    protected $class = PriceAggregate::class;

    protected $interface = PriceProviderSignature::class;

    public function testLogic()
    {
        $this->instance->method('execute')->willReturn(0.0);
        $command = new GetPriceCommand();
        $methodCallResponse = $this->instance->execute($command);
        $this->assertInstanceOf(GetPriceCommandSignature::class, $command);
        $this->assertTrue(is_float($methodCallResponse), 'Assert returns number');
    }
}
