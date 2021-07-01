<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\Constraint;

use DateInterval;
use DatePeriod;
use DateTime;
use Ticaje\BookingApi\Domain\Signatures\PeriodSignature;
use Ticaje\BookingApi\Domain\Signatures\WeekDaysSignature;

/**
 * Class WeekDays
 * @package Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\Constraint
 */
class WeekDays implements PeriodSignature, WeekDaysSignature
{
    /** @var int|string */
    private $numberOfYearsOn;

    /** @var array */
    private $monthToCover;

    /**
     * WeekDays constructor.
     *
     * @param string $numberOfYearsOn
     * @param string $monthToCover
     */
    public function __construct(
        string $numberOfYearsOn,
        string $monthToCover
    ) {
        $this->numberOfYearsOn = $numberOfYearsOn ?? self::NUMBER_OF_YEARS_TO_COME;
        $this->monthToCover = $monthToCover ? explode(',', $monthToCover) : self::MONTHS_RANGE;
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
