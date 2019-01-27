<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IpCheckRepository")
 */
class IpCheck
{
    /**
     * @ORM\Column(type="uuid")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $ip;

    public function __construct(string $ip)
    {
        $this->id = Uuid::uuid4();
        $this->ip = $ip;
    }

    public function getId(): string
    {
        return (string) $this->id;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
