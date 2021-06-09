<?php
declare(strict_types=1);

/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Application\UseCase\Command;

use Ticaje\Hexagonal\Test\Unit\Traits\DtoTestTrait;
use Ticaje\BookingApi\Test\Unit\Traits\SimplifiedDtoTestTrait;

use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Application\Signatures\UseCase\Command\GetCircuitCommandSignature;
use Ticaje\BookingApi\Application\UseCase\Command\GetCircuitCommand;

/**
 * Class GetCircuitCommandTest
 * @package Ticaje\BookingApi\Test\Unit\Application\UseCase
 */
class GetCircuitCommandTest extends ParentClass
{
    use DtoTestTrait, SimplifiedDtoTestTrait;

    protected $class = GetCircuitCommand::class;

    protected $interface = GetCircuitCommandSignature::class;

    protected $attributes = ['productId', 'storeId'];

    public function testSettersGetters()
    {
        $this->assertInstanceOf($this->interface, $this->instance->setProductId(5), 'Assert returns self object');
        $this->assertTrue(is_int($this->instance->getProductId()), 'Assert returns proper object, a number');
    }
}
