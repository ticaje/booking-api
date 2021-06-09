<?php
declare(strict_types=1);

/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Traits;

use Ticaje\Hexagonal\Application\Implementors\Responder\Response;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;

/**
 * Trait HandlerTestTrait
 * @package Ticaje\BookingApi\Test\Unit\Traits
 */
trait HandlerTestTrait
{
    public function setUp()
    {
        $this->instance = $this->getMockBuilder($this->class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->response = new Response();
    }

    public function testMethods()
    {
        $this->instance->method('handle')->willReturn($this->response);
        $command = new $this->command();
        $methodCallResponse = $this->instance->handle($command);
        $this->assertInstanceOf(ResponseInterface::class, $methodCallResponse, 'Assert returns self object');
        $this->assertTrue($methodCallResponse->getSuccess(), 'Assert returns success');
        $this->assertNull($methodCallResponse->getContent(), 'Assert returns empty content, since it is a mock');
    }
}
