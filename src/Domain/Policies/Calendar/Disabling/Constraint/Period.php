<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\Constraint;

use DatePeriod;
use DateInterval;
use DateTimeImmutable;
use Ticaje\BookingApi\Domain\Signatures\PeriodSignature;

/**
 * Class Period
 * @package Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\Constraint
 */
class Period implements PeriodSignature
{
    /**
     * @inheritDoc
     */
    public function extract(array $data): DatePeriod
    {
        $from = $data['from'];
        $to = $data['to'];

        return new DatePeriod(
            new DateTimeImmutable($from),
            new DateInterval('P1D'),
            new DateTimeImmutable($to)
        );
    }
}