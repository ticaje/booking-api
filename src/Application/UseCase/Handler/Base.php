<?php
declare(strict_types=1);
/**
 * Application Handler Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Handler;

use Ticaje\BookingApi\Application\Signatures\Provider\ServiceProviderSignature;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class Base
 * @package Ticaje\BookingApi\Application\UseCase\Handler
 */
abstract class Base implements HandlerInterface
{
    /** @var ResponseInterface  */
    protected $responder;

    /** @var ServiceProviderSignature  */
    protected $serviceProvider;

    /**
     * Base constructor.
     *
     * @param ResponseInterface        $responder
     * @param ServiceProviderSignature $serviceProvider
     */
    public function __construct(
        ResponseInterface $responder,
        ServiceProviderSignature $serviceProvider
    ) {
        $this->responder = $responder;
        $this->serviceProvider = $serviceProvider;
    }

    /**
     * @inheritDoc
     */
    abstract public function handle(UseCaseCommandInterface $command): ResponseInterface;
}
