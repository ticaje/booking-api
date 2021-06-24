<?php
declare(strict_types=1);

/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit;

use PHPUnit\Framework\TestCase as ParentClass;

/**
 * Class BaseTest
 * @package Ticaje\BookingApi\Test\Unit
 */
class BaseTest extends ParentClass
{
    protected $class;

    protected $instance;

    protected $interface;

    public function setUp()
    {
        $className = $this->class;
        $this->instance = new $className();
    }

    public function testProofOfLife()
    {
        $this->assertTrue(true);
    }

    public function testProperInterface()
    {
        $this->assertInstanceOf($this->interface, $this->instance);
    }
}
