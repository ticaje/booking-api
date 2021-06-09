<?php
declare(strict_types=1);

/**
 * Application Command Class
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Command;

use Ticaje\Contract\Traits\BaseDto;
use Ticaje\BookingApi\Application\Signatures\UseCase\Command\DisabledDaysCommandSignature;

/**
 * Class DisabledDaysCommand
 * @package Ticaje\BookingApi\Application\UseCase\Command
 */
class DisabledDaysCommand implements DisabledDaysCommandSignature
{
    use BaseDto;

    private $product;

    private $storeId = 0;

    private $format;
}
