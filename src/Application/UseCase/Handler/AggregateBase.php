<?php
declare(strict_types=1);
/**
 * Application Handler Class
 * @package Ticaje_BookingApi
 * @author  Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Handler;

use Exception;
use Ticaje\BookingApi\Application\Signatures\Provider\ServiceProviderSignature;
use Ticaje\Contract\Application\Service\ServiceLocatorInterface;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class AggregateBase
 * @package Ticaje\BookingApi\Application\UseCase\Handler
 */
abstract class AggregateBase implements HandlerInterface
{
    /** @var ResponseInterface */
    protected $responder;

    /** @var ServiceLocatorInterface */
    private $serviceLocator;

    /** @var string */
    private $serviceClassMapPath;

    /** @var string */
    private $aggregateName;

    /**
     * AggregateBase constructor.
     *
     * @param ResponseInterface       $responder
     * @param ServiceLocatorInterface $serviceLocator
     * @param string                  $serviceClassMapPath
     * @param string                  $aggregateName
     */
    public function __construct(
        ResponseInterface $responder,
        ServiceLocatorInterface $serviceLocator,
        string $serviceClassMapPath,
        string $aggregateName
    ) {
        $this->responder = $responder;
        $this->serviceLocator = $serviceLocator;
        $this->serviceClassMapPath = $serviceClassMapPath;
        $this->aggregateName = $aggregateName;
    }

    /**
     * @param UseCaseCommandInterface $command
     *
     * @return mixed
     * @throws Exception
     */
    protected function launchLogic(UseCaseCommandInterface $command)
    {
        /** @var ServiceProviderSignature $serviceProvider */
        $serviceProvider = $this->serviceLocator->get($this->getAggregateClassName($command));

        return $serviceProvider->execute($command);
    }

    /**
     * @param UseCaseCommandInterface $command
     *
     * @return string
     * @throws Exception
     */
    private function getAggregateClassName(UseCaseCommandInterface $command): string
    {
        if (!($aggregate = $command->getAggregate())) {
            throw new Exception('Aggregate does not exist');
        }

        return "{$this->serviceClassMapPath}\\{$aggregate}\\{$this->aggregateName}";
    }
}
