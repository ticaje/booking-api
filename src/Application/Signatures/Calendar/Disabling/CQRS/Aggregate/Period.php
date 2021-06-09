<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Calendar\Disabling\CQRS\Aggregate;

use DateInterval;
use DatePeriod;
use DateTime;
use Ticaje\BookingApi\Application\Signatures\Calendar\Disabling\CQRS\PeriodSignature;

/**
 * Class Period
 * @package Ticaje\BookingApi\Application\Signatures\Calendar\Disabling\CQRS\Aggregate
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
            new DateTime($from),
            new DateInterval('P1D'),
            new DateTime($to)
        );
    }
}
