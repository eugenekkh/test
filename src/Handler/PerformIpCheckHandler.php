<?php

namespace App\Handler;

use App\CommandBus\PerformIpCheckCommand;
use App\Entity\IpCheckResult;
use App\Provider\GeoDataProviderInterface;
use App\Repository\IpCheckResultRepositoryInterface;
use Exception;
use Psr\Log\LoggerInterface;

class PerformIpCheckHandler
{
    /**
     * @var GeoDataProviderInterface
     */
    private $provider;

    /**
     * @var IpCheckResultRepositoryInterface
     */
    private $repository;

    public function __construct(
        IpCheckResultRepositoryInterface $repository,
        GeoDataProviderInterface $provider,
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
        $this->provider = $provider;
        $this->repository = $repository;
    }

    public function handle(PerformIpCheckCommand $command): void
    {
        $geoData = null;

        try {
            $geoData = $this->provider->getGeoData($command->ipCheck->getIp());
        } catch (Exception $e) {
            $this->logger->warning('Can not perform ip check');

            return;
        }

        $ipCheckResult = new IpCheckResult($command->ipCheck, $geoData);

        $this->repository->add($ipCheckResult);
    }
}
