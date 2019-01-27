<?php

namespace App\Handler;

use App\CommandBus\AddIpToCheckCommand;
use App\Event\IpCheckAddedEvent;
use App\Entity\IpCheck;
use App\Repository\IpCheckRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AddIpToCheckHandler
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var IpCheckRepositoryInterface
     */
    private $repository;

    public function __construct(EventDispatcherInterface $eventDispatcher, IpCheckRepositoryInterface $repository)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->repository = $repository;
    }

    public function handle(AddIpToCheckCommand $command): void
    {
        $ipCheck = new IpCheck($command->ip);

        $ipCheck = $this->repository->add($ipCheck);

        $this->eventDispatcher->dispatch(IpCheckAddedEvent::NAME, new IpCheckAddedEvent($ipCheck));
    }
}
