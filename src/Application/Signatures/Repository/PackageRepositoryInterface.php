<?php
declare(strict_types=1);
/**
 * Repository Interface
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Repository;

use Ticaje\Contract\Persistence\Entity\EntityInterface;
use Ticaje\Contract\Persistence\Repository\RepositoryInterface;

/**
 * Interface PackageRepositoryInterface
 * @package Ticaje\BookingApi\Application\Signatures\Repository
 */
interface PackageRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $productId
     * @param int $storeId
     *
     * @return array
     */
    public function getPlan(int $productId, int $storeId): array;

    /**
     * @param int $productId
     * @param int $storeId
     *
     * @return EntityInterface
     */
    public function getByProductAndStore(int $productId, int $storeId = 0): EntityInterface;

}
