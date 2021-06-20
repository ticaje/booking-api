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
 * Class GetPackageHandler
 * @package Ticaje\BookingApi\Application\UseCase\Handler
 */
class GetPackageHandler extends Base implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(UseCaseCommandInterface $command): ResponseInterface
    {
        $content = $this->serviceProvider->execute($command);
        $this->responder
            ->setSuccess(true)
            ->setMessage('Prices fetched successfully!!')
            ->setContent($content);

        return $this->responder;
    }
}
