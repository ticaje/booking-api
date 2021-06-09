<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package     Ticaje_BookingApi
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider\HotelRoom;

use Ticaje\BookingApi\Application\Service\Provider\BasePriceProvider;
use Ticaje\BookingApi\Application\Signatures\Provider\PriceProviderSignature;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class Price
 * @package Ticaje\BookingApi\Application\Service\Provider\HotelRoom
 */
class Price extends BasePriceProvider implements PriceProviderSignature
{
    /**
     * @inheritDoc
     */
    public function getPrice(UseCaseCommandInterface $command): float
    {
        $days = $this->calculateDays($command);
        $price = $this->instance->getPrice();
        $price *= (int)$days->days;

        return (float)$price;
    }
}
