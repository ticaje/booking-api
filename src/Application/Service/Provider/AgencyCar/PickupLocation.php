<?php
declare(strict_types=1);
/**
 * Application Service Class
 * @package     Ticaje_BookingApi
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Service\Provider\AgencyCar;

use Ticaje\BookingApi\Application\Repository\AssignedRepositoryInterface;
use Ticaje\BookingApi\Application\Repository\DisabledRepositoryInterface;
use Ticaje\BookingApi\Application\Signatures\Provider\ServiceProviderSignature;
use Ticaje\Contract\Persistence\Repository\RepositoryInterface as BaseRepositoryInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class PickupLocation
 * @package Ticaje\BookingApi\Application\Service\Provider\AgencyCar
 */
class PickupLocation implements ServiceProviderSignature
{
    /** @var AssignedRepositoryInterface $assignedRepository */
    private $assignedRepository;

    /** @var DisabledRepositoryInterface $disabledRepository */
    private $disabledRepository;

    /**
     * PickupLocation constructor.
     *
     * @param BaseRepositoryInterface $assignedRepository
     * @param BaseRepositoryInterface $disabledRepository
     */
    public function __construct(
        BaseRepositoryInterface $assignedRepository,
        BaseRepositoryInterface $disabledRepository
    ) {
        $this->assignedRepository = $assignedRepository;
        $this->disabledRepository = $disabledRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(UseCaseCommandInterface $command)
    {
        $result = [];
        $assigned = $this->assignedRepository->getAssignedForCar($command->getProductId());
        foreach ($assigned as $item) {
            $disabled = $this->disabledRepository->getDisabledRulesForLocationAndCar($item->getId(), $command->getFromDate(), $command->getToDate());
            if (count($disabled) > 0) {
                continue;
            }
            $result[$item->getId()] = $item;
        }

        return $result;
    }
}
