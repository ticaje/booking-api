<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider\Circuit;

use Ticaje\BookingApi\Application\Repository\CircuitRepositoryInterface;
use Ticaje\BookingApi\Application\Signatures\Provider\Circuit\CircuitProviderSignature;
use Ticaje\Contract\Persistence\Entity\EntityInterface;
use Ticaje\Contract\Persistence\Repository\RepositoryInterface as BaseRepositoryInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class Circuit
 * @package Ticaje\BookingApi\Application\Service\Provider
 */
class Circuit implements CircuitProviderSignature
{
    /** @var CircuitRepositoryInterface $circuitRepository */
    private $circuitRepository;

    /** @var EntityInterface $circuit */
    private $circuit;

    public function __construct(
        BaseRepositoryInterface $circuitRepository
    ) {
        $this->circuitRepository = $circuitRepository;
    }

    /**
     * @inheritDoc
     */
    public function instance(UseCaseCommandInterface $command): CircuitProviderSignature
    {
        $productId = $command->getProductId();
        $storeId = $command->getStoreId();
        $this->circuit = $this->circuitRepository->getByProductAndStore($productId, $storeId);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAvailability(int $from, int $to): bool
    {
        // @todo implementation
    }

    /**
     * @inheritDoc
     */
    public function getDepartureDays(): array
    {
        $result = unserialize($this->circuit->getDepartureDays());

        return array_map(function ($value) {
            return $value - 1;
        }, $result);
    }

    /**
     * @inheritDoc
     */
    public function getNumberOfNights(): int
    {
        return (int)$this->circuit->getNumberOfNights();
    }

    /**
     * @inheritDoc
     */
    public function getDateTo(): string
    {
        return $this->circuit->getDateTo();
    }
}
