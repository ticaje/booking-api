<?php
declare(strict_types=1);

/**
 * Application Command Class
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Command;

use Ticaje\Contract\Traits\BaseDto;

use Ticaje\BookingApi\Application\Signatures\UseCase\Command\AvailabilityCommandSignature;

/**
 * Class GetAvailabilityCommand
 * @package Ticaje\BookingApi\Application\UseCase\Command
 */
class GetAvailabilityCommand implements AvailabilityCommandSignature
{
    use BaseDto;

    private $productId;

    private $storeId = 0;

    private $fromDate;

    private $toDate;
}
