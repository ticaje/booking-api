<?php
declare(strict_types=1);

/**
 * Application Command Class
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Command;

use Ticaje\Contract\Traits\BaseDto;

use Ticaje\BookingApi\Application\Signatures\UseCase\Command\GetPackageCommandSignature;

/**
 * Class GetPackageCommand
 * @package Ticaje\BookingApi\Application\UseCase\Command
 */
class GetPackageCommand implements GetPackageCommandSignature
{
    use BaseDto;

    private $productId;

    private $storeId = 0;
}
