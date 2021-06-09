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
 * Interface GetPriceCommandSignature
 * @package Ticaje\BookingApi\Application\Signatures\UseCase\Command
 */
interface GetPriceCommandSignature extends UseCaseCommandInterface
{
    /**
     * @param $product
     * @return GetPriceCommandSignature
     */
    public function setProduct(&$product): GetPriceCommandSignature;
}
