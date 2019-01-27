<?php

namespace App\CommandBus;

use App\Entity\IpCheck;

class PerformIpCheckCommand
{
    /**
     * @var IpCheck
     */
    public $ipCheck;

    public static function create(IpCheck $ipCheck): self
    {
        $command = new static();
        $command->ipCheck = $ipCheck;

        return $command;
    }
}
