<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider\Package;

use Ticaje\BookingApi\Application\Service\Provider\BasePriceProvider;
use Ticaje\BookingApi\Application\Signatures\Provider\PriceProviderSignature;
use Ticaje\Contract\Patterns\Interfaces\Dto\DtoInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class Price
 * @package Ticaje\BookingApi\Application\Service\Provider
 */
class PriceAggregate extends BasePriceProvider implements PriceProviderSignature
{
    /**
     * @inheritDoc
     */
    protected function getBasePrice(UseCaseCommandInterface $command): float
    {
        /** @var DtoInterface $product */
        $product = $command->getProduct();
        $result = $product ? $product->getPrice() : 0;

        return (float)$result;
    }

    /**
     * @inheritDoc
     */
    public function getPrice(UseCaseCommandInterface $command): float
    {
        return (float)$this->instance->getPrice();
    }
}
