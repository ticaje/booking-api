<?php
declare(strict_types=1);

/**
 * Application Service Interface
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Provider\Package;

use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Interface PackageProviderSignature
 * @package Ticaje\BookingApi\Application\Signatures\Provider
 */
interface PackageProviderSignature
{
    /**
     * @param UseCaseCommandInterface $command
     * @return mixed
     */
    public function instance(UseCaseCommandInterface $command): PackageProviderSignature;

    /**
     * @return int
     */
    public function getNumberOfNights(): int;

    /**
     * @return array
     */
    public function getDepartureDays(): array;

    /**
     * @param int $from
     * @param int $to
     * @return bool
     */
    public function getAvailability(int $from, int $to): bool;

    /**
     * @return string
     */
    public function getDateTo(): string;
}
