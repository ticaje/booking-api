<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS;

/**
 * Interface QuerySignature
 * @package Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS
 */
interface QuerySignature
{
    /**
     * @param string $rule
     * @param string $type
     *
     * @return QuerySignature
     */
    public function interpret(string $rule, string $type): QuerySignature;

    /**
     * @return array
     */
    public function fetchList(): array;
}
