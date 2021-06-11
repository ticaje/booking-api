<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS;

use Exception;

/**
 * Trait Validator
 * @package Ticaje\BookingApi\Domain\Policies\Calendar\Disabling\CQRS
 */
trait Validator
{
    /**
     * @param $decodedRule
     * @param $type
     *
     * @return bool
     * @throws Exception
     */
    private function validate($decodedRule, $type): bool
    {
        switch ($type) {
            case 'single':
                if (isset($decodedRule['date'])) {
                    return $decodedRule;
                }
                break;
            case 'period':
                if (isset($decodedRule['from']) && isset($decodedRule['to'])) {
                    return true;
                }
                break;
            case 'recurrent_day':
                if (isset($decodedRule['dayOfWeek'])) {
                    return true;
                }
                break;
        }
        $this->throwException();
    }

    /**
     * @throws Exception
     */
    private function throwException()
    {
        throw new Exception(self::VALIDATION_ERROR);
    }
}
