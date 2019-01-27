<?php

namespace App\Event;

use App\Entity\IpCheck;
use Symfony\Component\EventDispatcher\Event;

class IpCheckAddedEvent extends Event
{
    const NAME = 'app.ip_check_added';

    /**
     * @var IpCheck
     */
    protected $ipCheck;

    public function __construct(IpCheck $ipCheck)
    {
        $this->ipCheck = $ipCheck;
    }

    public function getIpCheck(): IpCheck
    {
        return $this->ipCheck;
    }
}
