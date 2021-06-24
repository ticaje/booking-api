<?php
declare(strict_types=1);
/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Application\UseCase\Command;

use Ticaje\BookingApi\Application\Signatures\UseCase\Command\GetPackageCommandSignature;
use Ticaje\BookingApi\Application\UseCase\Command\GetPackageCommand;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\SimplifiedDtoTestTrait;
use Ticaje\Hexagonal\Test\Unit\Traits\DtoTestTrait;

/**
 * Class GetPackageCommandTest
 * @package Ticaje\BookingApi\Test\Unit\Application\UseCase
 */
class GetPackageCommandTest extends ParentClass
{
    use DtoTestTrait, SimplifiedDtoTestTrait;

    protected $class = GetPackageCommand::class;

    protected $interface = GetPackageCommandSignature::class;

    protected $attributes = [
        'productId',
        'storeId',
    ];

    public function testSettersGetters()
    {
        $this->assertInstanceOf($this->interface, $this->instance->setProductId(5), 'Assert returns self object');
        $this->assertTrue(is_int($this->instance->getProductId()), 'Assert returns proper object, a number');
    }
}
