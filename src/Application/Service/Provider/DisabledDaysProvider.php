<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider;

use Exception;
use Ticaje\BookingApi\Application\Signatures\Provider\DisabledDaysGatewaySignature;
use Ticaje\BookingApi\Application\Signatures\Provider\DisabledDaysProviderSignature;
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS\Query;
use Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS\QuerySignature;
use Ticaje\Contract\Application\Service\ServiceLocatorInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class DisabledDaysProvider
 * @package Ticaje\BookingApi\Application\Service\Provider
 */
class DisabledDaysProvider implements DisabledDaysProviderSignature
{
    private $serviceLocator;

    private $disabledDaysGatewaySignature;

    public function __construct(
        ServiceLocatorInterface $serviceLocator,
        DisabledDaysGatewaySignature $disabledDaysGatewaySignature)
    {
        $this->serviceLocator = $serviceLocator;
        $this->disabledDaysGatewaySignature = $disabledDaysGatewaySignature;
    }

    /**
     * @inheritDoc
     */
    public function execute(UseCaseCommandInterface $command)
    {
        $items = $this->disabledDaysGatewaySignature->execute($command);

        return $this->transform($items, $command->getFormat());
    }

    /**
     * @param array $items
     * @param       $format
     *
     * @return string
     */
    private function transform(array $items, $format): string
    {
        /** @var QuerySignature $domainFetcher */
        $domainFetcher = $this->serviceLocator->get(Query::class, ['format' => $format]);
        foreach ($items as $item) {
            try {
                $domainFetcher->interpret($item->getRule(), $item->getType());
            } catch (Exception $exception) {
                // Log properly
            }
        }

        return json_encode($domainFetcher->fetchList());
    }
}
