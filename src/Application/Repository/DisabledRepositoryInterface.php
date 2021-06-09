<?php
declare(strict_types=1);
/**
 * Repository Interface
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Repository;

use Ticaje\Contract\Persistence\Repository\RepositoryInterface;

/**
 * Interface DisabledRepositoryInterface
 * @package Ticaje\BookingApi\Application\Repository
 */
interface DisabledRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $carId
     *
     * @return array
     */
    public function getDisabledRulesForCar(int $carId): array;

    /**
     * @param int $locationId
     *
     * @return array
     */
    public function getDisabledRulesForLocation(int $locationId): array;

    /**
     * @param $locationCarId
     * @param $from
     * @param $to
     *
     * @return array
     */
    public function getDisabledRulesForLocationAndCar($locationCarId, $from, $to): array;
}
