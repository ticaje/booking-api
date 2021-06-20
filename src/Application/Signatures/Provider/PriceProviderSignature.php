<?php
declare(strict_types=1);
/**
 * Application Service Interface
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Provider;

use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Interface PriceProviderSignature
 * @package Ticaje\BookingApi\Application\Signatures\Provider
 */
interface PriceProviderSignature extends ServiceProviderSignature
{
    const AGGREGATE_AGENCY_CAR = 'AgencyCar';
    const AGGREGATE_HOTEL_ROOM = 'HotelRoom';
    const AGGREGATE_CIRCUIT = 'Package';

    /**
     * @param UseCaseCommandInterface $command
     *
     * @return float
     */
    public function getPrice(UseCaseCommandInterface $command): float;
}
