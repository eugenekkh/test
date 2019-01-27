<?php

namespace App\CommandBus;

use App\Entity\IpCheck;
use Symfony\Component\Validator\Constraints as Assert;

class AddIpToCheckCommand
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Ip(version="all")
     */
    public $ip;

    public static function create(string $ip): self
    {
        $command = new static();
        $command->ip = $ip;

        return $command;
    }
}
