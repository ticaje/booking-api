<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 * @author  Lino Aboy <linodeveloper85@gmail.com>
 */

namespace Ticaje\BookingApi\Application\Service\Provider;

use DateInterval;
use DateTime;
use Exception;
use Ticaje\BookingApi\Application\Signatures\Provider\PriceProviderGatewaySignature;
use Ticaje\BookingApi\Application\Signatures\Provider\PriceProviderSignature;
use Ticaje\BookingApi\Application\Signatures\Provider\ServiceProviderSignature;
use Ticaje\Contract\Patterns\Interfaces\Dto\DtoInterface;
use Ticaje\Contract\Persistence\Entity\EntityInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class BasePriceProvider
 * @package Ticaje\BookingApi\Application\Service\Provider
 */
abstract class BasePriceProvider implements ServiceProviderSignature, PriceProviderSignature
{
    /** @var EntityInterface instance */
    protected $instance;

    /** @var PriceProviderGatewaySignature $priceProviderGatewaySignature */
    private $priceProviderGatewaySignature;

    /**
     * BasePriceProvider constructor.
     *
     * @param PriceProviderGatewaySignature $priceProviderGatewaySignature
     */
    public function __construct(PriceProviderGatewaySignature $priceProviderGatewaySignature)
    {
        $this->priceProviderGatewaySignature = $priceProviderGatewaySignature;
    }

    /**
     * @inheritDoc
     */
    public function execute(UseCaseCommandInterface $command)
    {
        $price = (float)0;
        if ($this->instance = $this->priceProviderGatewaySignature->execute($command)) {
            $price = $this->getPrice($command);
        }

        return (float)0 === $price ? $this->getBasePrice($command) : $price;
    }

    /**
     * @param UseCaseCommandInterface $command
     *
     * @return float|int
     * @throws Exception
     */
    protected function getBasePrice(UseCaseCommandInterface $command): float
    {
        /** @var DtoInterface $product */
        $product = $command->getProduct();
        $days = $this->calculateDays($command);
        $result = $product ? $product->getPrice() * (int)$days->days : 0;

        return (float)$result;
    }

    /**
     * @param UseCaseCommandInterface $command
     *
     * @return float
     */
    abstract public function getPrice(UseCaseCommandInterface $command): float;

    /**
     * @param UseCaseCommandInterface $command
     *
     * @return DateInterval|false
     * @throws Exception
     */
    protected function calculateDays(UseCaseCommandInterface $command)
    {
        $from = $command->getFromDate();
        $to = $command->getToDate();

        return date_diff(new DateTime($to), new DateTime($from));
    }
}
