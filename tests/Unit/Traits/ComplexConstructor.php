<?php
declare(strict_types=1);

/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Traits;

/**
 * Trait ComplexConstructor
 * @package Ticaje\BookingApi\Test\Unit\Traits
 */
trait ComplexConstructor
{
    public function setUp()
    {
        $this->instance = $this->getMockBuilder($this->class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
