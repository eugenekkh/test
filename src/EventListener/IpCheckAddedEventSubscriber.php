<?php

namespace App\EventListener;

use App\CommandBus\PerformIpCheckCommand;
use App\Event\IpCheckAddedEvent;
use League\Tactician\CommandBus;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class IpCheckAddedEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public static function getSubscribedEvents(): array
    {
        return [
            IpCheckAddedEvent::NAME => 'performIpCheck',
        ];
    }

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function performIpCheck(IpCheckAddedEvent $event): void
    {
        $performCheckCommand = new PerformIpCheckCommand();
        $performCheckCommand->ipCheck = $event->getIpCheck();

        $this->commandBus->handle($performCheckCommand);
    }
}
