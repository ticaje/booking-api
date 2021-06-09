<?php
declare(strict_types=1);
/**
 * Application Handler Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Handler;

use Exception;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class GetPickupLocationHandler
 * @package Ticaje\BookingApi\Application\UseCase\Handler
 */
class GetPickupLocationHandler extends AggregateBase implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(UseCaseCommandInterface $command): ResponseInterface
    {
        try {
            $this->responder
                ->setSuccess(true)
                ->setMessage('Prices fetched successfully!!!')
                ->setContent($this->launchLogic($command));
        } catch (Exception $exception) {
            $this->responder
                ->setSuccess(false)
                ->setMessage('There was a problem with price providing service!!! ')
                ->setContent(0);
        }

        return $this->responder;
    }
}
