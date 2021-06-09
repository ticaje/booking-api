<?php
declare(strict_types=1);

/**
 * Repository Interface
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Repository;

use Ticaje\Contract\Persistence\Repository\RepositoryInterface;

/**
 * Interface AssignedRepositoryInterface
 * @package Ticaje\BookingApi\Application\Signatures\Repository
 */
interface AssignedRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $locationId
     * @return array
     */
    public function getAssignedForLocation(int $locationId): array;

    /**
     * @param int $carId
     * @return array
     */
    public function getAssignedForCar(int $carId): array;
}
