<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider\Circuit;

use Ticaje\BookingApi\Application\Signatures\Provider\Circuit\PlanProviderSignature;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class Plan
 * @package Ticaje\BookingApi\Application\Service\Provider
 */
class Plan implements PlanProviderSignature
{
    /**
     * @inheritDoc
     */
    public function fetch(UseCaseCommandInterface $command)
    {
        // TODO: Implement fetch() method.
    }

    public function execute(UseCaseCommandInterface $command)
    {
        // TODO: Implement execute() method.
    }
}
