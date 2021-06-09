<?php
declare(strict_types=1);

/**
 * Application Service Class
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider;

use Ticaje\BookingApi\Application\Signatures\Provider\AvailabilityProviderSignature;

use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class AvailabilityProvider
 * @package Ticaje\BookingApi\Application\Service\Provider
 */
class AvailabilityProvider implements AvailabilityProviderSignature
{
    public function execute(UseCaseCommandInterface $command)
    {
        // TODO: Implement execute() method.
    }
}
