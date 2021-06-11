<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Domain\Signatures;

/**
 * Interface WeekDaysSignature
 * @package Ticaje\BookingApi\Domain\Signatures
 */
interface WeekDaysSignature
{
    const MONTHS_RANGE = [
        1,
        12,
    ];

    const NUMBER_OF_YEARS_TO_COME = 1;
}
