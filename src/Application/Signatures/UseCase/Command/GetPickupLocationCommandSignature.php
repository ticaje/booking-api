<?php
declare(strict_types=1);

/**
 * Application Command Interface
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\UseCase\Command;

use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Interface GetPickupLocationCommandSignature
 * @package Ticaje\BookingApi\Application\Signatures\UseCase\Command
 */
interface GetPickupLocationCommandSignature extends UseCaseCommandInterface
{
    /**
     * @param $product
     * @return GetPickupLocationCommandSignature
     */
    public function setProduct(&$product): GetPickupLocationCommandSignature;
}
