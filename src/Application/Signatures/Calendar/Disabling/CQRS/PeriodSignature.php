<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Calendar\Disabling\CQRS;

use DatePeriod;

/**
 * Interface PeriodSignature
 * @package Ticaje\BookingApi\Application\Signatures\Calendar\Disabling\CQRS
 */
interface PeriodSignature
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function extract(array $data): DatePeriod;
}
