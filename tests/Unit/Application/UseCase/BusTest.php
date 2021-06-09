<?php
declare(strict_types=1);

/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Application\UseCase\Handler;

use Ticaje\Hexagonal\Application\Signatures\UseCase\BusFacadeInterface;

use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Application\UseCase\Bus;

/**
 * Class BusTest
 * @package Ticaje\BookingApi\Test\Unit\Application\UseCase\Handler
 */
class BusTest extends ParentClass
{
    protected $class = Bus::class;

    protected $interface = BusFacadeInterface::class;

    public function setUp()
    {
        $this->instance = $this->getMockBuilder($this->class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
