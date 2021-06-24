<?php
declare(strict_types=1);
/**
 * Test Suite
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Test\Unit\Application\UseCase\Handler;

use Ticaje\BookingApi\Application\UseCase\Command\GetPriceCommand;
use Ticaje\BookingApi\Application\UseCase\Handler\GetPriceHandler;
use Ticaje\BookingApi\Test\Unit\BaseTest as ParentClass;
use Ticaje\BookingApi\Test\Unit\Traits\HandlerTestTrait;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;

/**
 * Class GetPriceHandlerTest
 * @package Ticaje\BookingApi\Test\Unit\Application\UseCase\Handler
 */
class GetPriceHandlerTest extends ParentClass
{
    use HandlerTestTrait;

    private $response;

    private $command = GetPriceCommand::class;

    protected $class = GetPriceHandler::class;

    protected $interface = HandlerInterface::class;
}
