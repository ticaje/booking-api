<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Domain\Signatures;

use DatePeriod;

/**
 * Interface PeriodSignature
 * @package Ticaje\BookingApi\Domain\Signatures
 */
interface PeriodSignature
{
    const DEFAULT_FORMAT = 'Y-m-d';

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function extract(array $data): DatePeriod;
}
