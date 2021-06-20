<?php
declare(strict_types=1);
/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Application\Service\Provider\Package;

use Ticaje\BookingApi\Application\Service\Provider\Package\Price;
use Ticaje\BookingApi\Application\Signatures\Provider\PriceProviderSignature;
use Ticaje\BookingApi\Application\Signatures\UseCase\Command\GetPriceCommandSignature;
use Ticaje\BookingApi\Application\UseCase\Command\GetPriceCommand;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;

/**
 * Class PriceTest
 * @package Ticaje\BookingApi\Test\Unit\Application\Service\Provider
 */
class PriceTest extends ParentClass
{
    protected $class = Price::class;

    protected $interface = PriceProviderSignature::class;

    public function setUp()
    {
        $this->instance = $this->getMockBuilder($this->class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testLogic()
    {
        $this->instance->method('execute')->willReturn(0.0);
        $command = new GetPriceCommand();
        $methodCallResponse = $this->instance->execute($command);
        $this->assertInstanceOf(GetPriceCommandSignature::class, $command);
        $this->assertTrue(is_float($methodCallResponse), 'Assert returns number');
    }
}
