<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS;

use DatePeriod;
use DateTimeInterface;
use Ticaje\BookingApi\Domain\Signatures\PeriodSignature;

/**
 * Class Query
 * @package Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS
 */
class Query implements QuerySignature
{
    use Validator;

    /** @var array */
    private $list = [];

    /** @var string */
    private $format;

    /** @var Constraint\WeekDays */
    private $weekDaysConstraint;

    /** @var Constraint\Period */
    private $periodConstraint;

    /**
     * Query constructor.
     *
     * @param Constraint\WeekDays $weekDaysConstraint
     * @param Constraint\Period   $periodConstraint
     * @param string              $format
     */
    public function __construct(
        Constraint\WeekDays $weekDaysConstraint,
        Constraint\Period $periodConstraint,
        string $format = PeriodSignature::DEFAULT_FORMAT
    ) {
        $this->format = $format;
        $this->weekDaysConstraint = $weekDaysConstraint;
        $this->periodConstraint = $periodConstraint;
    }

    /**
     * @inheritDoc
     */
    public function interpret(string $rule, string $type): QuerySignature
    {
        $decoded = $this->decode($rule);
        $this->validate($decoded, $type);
        $result = [
            'single'        => (function () use ($decoded) {
                $period = $this->periodConstraint->extract([
                    'from' => $decoded['date'],
                    'to'   => $decoded['date'],
                ]);

                return $this->extract($period);
            }),
            'period'        => (function () use ($decoded) {
                $period = $this->periodConstraint->extract($decoded);

                return $this->extract($period);
            }),
            'recurrent_day' => (function () use ($decoded) {
                $dayOfWeek = jddayofweek($decoded['dayOfWeek'] - 1, 1);
                $period = $this->weekDaysConstraint->extract([
                    'weekDay' => $dayOfWeek,
                    'year'    => date("Y"),
                    'month'   => date("m"),
                ]);

                return $this->extract($period);
            }),
        ];
        $result[$type]();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function fetchList(): array
    {
        usort($this->list, function ($previous, $next) {
            $previousDate = strtotime($previous);
            $nextDate = strtotime($next);

            return ($previousDate - $nextDate);
        });

        return $this->list;
    }

    /**
     * @param $rule
     *
     * @return mixed
     * It's separated since it could change
     */
    private function decode($rule)
    {
        return json_decode($rule, true);
    }

    /**
     * @param DatePeriod $period
     * Given a period, extract proper dates based upon two constraints: greater than current date and not existing
     * in current list
     */
    private function extract(DatePeriod $period)
    {
        $today = date($this->format);
        /**
         * @var                   $key
         * @var DateTimeInterface $date
         */
        foreach ($period as $key => $date) {
            $value = $date->format($this->format);
            if ($value >= $today && !in_array($value, $this->list)) {
                $this->list[] = $value;
            }
        }
    }
}
