<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS;

use DatePeriod;

/**
 * Class Query
 * @package Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS
 */
class Query implements QuerySignature
{
    private $list = [];

    private $format;

    private $weekDaysAggregate;

    private $periodAggregate;

    public function __construct(
        Aggregate\WeekDays $weekDaysAggregate,
        Aggregate\Period $periodAggregate,
        string $format = 'Y-m-d'
    ) {
        $this->format = $format;
        $this->weekDaysAggregate = $weekDaysAggregate;
        $this->periodAggregate = $periodAggregate;
    }

    /**
     * @inheritDoc
     */
    public function interpret(string $rule, string $type): QuerySignature
    {
        $decoded = $this->decode($rule);
        $result = [
            'single' => (function () use ($decoded) {
                $period = $this->periodAggregate->extract([
                    'from' => $decoded['date'],
                    'to'   => $decoded['date'],
                ]);

                return $this->extract($period);
            }),
            'period' => (function () use ($decoded) {
                $period = $this->periodAggregate->extract($decoded);

                return $this->extract($period);
            }),
            'recurrent_day' => (function () use ($decoded) {
                $dayOfWeek = jddayofweek($decoded['dayOfWeek'] - 1, 1);
                $period = $this->weekDaysAggregate->extract([
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
     * Given a period, extract proper dates based upon two constraints: greater than current date and not not existing
     * in current list
     */
    private function extract(DatePeriod $period)
    {
        $today = date($this->format);
        foreach ($period as $key => $date) {
            $value = $date->format($this->format);
            if ($value >= $today && !in_array($value, $this->list)) {
                $this->list[] = $value;
            }
        }
    }
}
