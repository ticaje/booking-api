<?php
declare(strict_types=1);
/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Application\UseCase\Command;

use Ticaje\BookingApi\Application\Signatures\UseCase\Command\AvailabilityCommandSignature;
use Ticaje\BookingApi\Application\UseCase\Command\GetAvailabilityCommand;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\SimplifiedDtoTestTrait;
use Ticaje\Hexagonal\Test\Unit\Traits\DtoTestTrait;

/**
 * Class GetAvailabilityCommandTest
 * @package Ticaje\BookingApi\Test\Unit\Application\UseCase
 */
class GetAvailabilityCommandTest extends ParentClass
{
    use DtoTestTrait, SimplifiedDtoTestTrait;

    protected $class = GetAvailabilityCommand::class;

    protected $interface = AvailabilityCommandSignature::class;

    protected $attributes = [
        'productId',
        'storeId',
        'fromDate',
        'toDate',
    ];

    public function testSettersGetters()
    {
        $this->assertInstanceOf($this->interface, $this->instance->setProductId(5), 'Assert returns self object');
        $this->assertTrue(is_int($this->instance->getProductId()), 'Assert returns proper object, a number');
    }
}
