<?php
declare(strict_types=1);
/**
 * Application Handler Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Handler;

use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class DisabledDaysHandler
 * @package Ticaje\BookingApi\Application\UseCase\Handler
 */
class DisabledDaysHandler extends Base implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(UseCaseCommandInterface $command): ResponseInterface
    {
        $content = $this->serviceProvider->execute($command);
        $this->responder
            ->setSuccess(true)
            ->setMessage('Disabled Days Fetched Successfully!!')
            ->setContent($content);

        return $this->responder;
    }
}
