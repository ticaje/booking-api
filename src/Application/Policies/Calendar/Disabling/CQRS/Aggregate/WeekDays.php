<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS\Aggregate;

use DateInterval;
use DatePeriod;
use DateTime;
use Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS\PeriodSignature;

/**
 * Class WeekDays
 * @package Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS\Aggregate
 */
class WeekDays implements PeriodSignature
{
    private $numberOfYearsOn;

    private $monthToCover;

    public function __construct(
        string $numberOfYearsOn,
        string $monthToCover
    ) {
        $this->numberOfYearsOn = $numberOfYearsOn ?? 1;
        $this->monthToCover = $monthToCover ? explode(',', $monthToCover) : [
            1,
            12,
        ];
    }

    /**
     * @inheritDoc
     */
    public function extract(array $data): DatePeriod
    {
        $year = $data['year'];
        $yearTo = $year + $this->numberOfYearsOn;
        $weekDay = $data['weekDay'];

        return new DatePeriod(
            new DateTime("first $weekDay of $year-{$this->monthToCover[0]}"),
            DateInterval::createFromDateString("next $weekDay"),
            new DateTime("last day of $yearTo-{$this->monthToCover[1]}")
        );
    }
}
