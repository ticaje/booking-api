<?php
declare(strict_types=1);
/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS;

/**
 * Interface CommandSignature
 * @package Ticaje\BookingApi\Application\Policies\Calendar\Disabling\CQRS
 */
interface CommandSignature
{
    /**
     * @param array $input
     *
     * @return mixed
     */
    public function extractType(array $input): array;
}
