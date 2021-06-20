<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider\Package;

use Ticaje\BookingApi\Application\Repository\PackageRepositoryInterface;
use Ticaje\BookingApi\Application\Signatures\Provider\Package\PackageProviderSignature;
use Ticaje\Contract\Persistence\Entity\EntityInterface;
use Ticaje\Contract\Persistence\Repository\RepositoryInterface as BaseRepositoryInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class Package
 * @package Ticaje\BookingApi\Application\Service\Provider
 */
class Package implements PackageProviderSignature
{
    /** @var PackageRepositoryInterface $packageRepository */
    private $packageRepository;

    /** @var EntityInterface $package */
    private $package;

    /**
     * Package constructor.
     *
     * @param BaseRepositoryInterface $packageRepository
     */
    public function __construct(
        BaseRepositoryInterface $packageRepository
    ) {
        $this->packageRepository = $packageRepository;
    }

    /**
     * @inheritDoc
     */
    public function instance(UseCaseCommandInterface $command): PackageProviderSignature
    {
        $productId = $command->getProductId();
        $storeId = $command->getStoreId();
        $this->package = $this->packageRepository->getByProductAndStore($productId, $storeId);

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
        $result = unserialize($this->package->getDepartureDays());

        return array_map(function ($value) {
            return $value - 1;
        }, $result);
    }

    /**
     * @inheritDoc
     */
    public function getNumberOfNights(): int
    {
        return (int)$this->package->getNumberOfNights();
    }

    /**
     * @inheritDoc
     */
    public function getDateTo(): string
    {
        return $this->package->getDateTo();
    }
}
