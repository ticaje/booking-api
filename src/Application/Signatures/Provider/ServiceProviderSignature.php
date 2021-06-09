<?php
declare(strict_types=1);

/**
 * Application Service Interface
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Provider;

use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Interface ServiceProviderSignature
 * @package Ticaje\BookingApi\Application\Signatures\Provider
 */
interface ServiceProviderSignature
{
    /**
     * @param UseCaseCommandInterface $command
     * @return mixed
     */
    public function execute(UseCaseCommandInterface $command);
}
