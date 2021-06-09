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
use Ticaje\BookingApi\Application\Signatures\UseCase\Command\GetPriceCommandSignature;
use Ticaje\BookingApi\Application\UseCase\Command\GetPriceCommand;

/**
 * Class GetPriceCommandTest
 * @package Ticaje\BookingApi\Test\Unit\Application\UseCase
 */
class GetPriceCommandTest extends ParentClass
{
    use DtoTestTrait;

    public $propertiesNumber = 5;

    protected $class = GetPriceCommand::class;

    protected $interface = GetPriceCommandSignature::class;

    protected $attributes = ['product', 'storeId', 'fromDate', 'toDate', 'aggregate'];

    public function testSettersGetters()
    {
        $this->assertInstanceOf($this->interface, $this->instance->setProductId(5), 'Assert returns self object');
        $this->assertTrue(is_int($this->instance->getProductId()), 'Assert returns proper object, a number');
    }
}
