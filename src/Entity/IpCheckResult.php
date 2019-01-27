<?php

namespace App\Entity;

use DateTime;
use App\Entity\GeoData\GeoData;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IpCheckResultRepository")
 */
class IpCheckResult
{
    /**
     * @ORM\Column(type="uuid")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="IpCheck")
     * @ORM\JoinColumn(name="ipcheck_id", referencedColumnName="id")
     */
    private $ipCheck;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $checkedAt;

    /**
     * @ORM\Embedded(class = "App\Entity\GeoData\GeoData")
     */
    private $geoData;

    public function __construct(IpCheck $ipCheck, GeoData $geoData)
    {
        $this->id = Uuid::uuid4();
        $this->ipCheck = $ipCheck;
        $this->checkedAt = new DateTime();
        $this->geoData = $geoData;
    }

    public function getId(): string
    {
        return (string) $this->id;
    }

    public function getIpCheck(): IpCheck
    {
        return $this->ipCheck;
    }

    public function getCheckedAt(): DateTime
    {
        return $this->checkedAt;
    }

    public function getGeoData(): GeoData
    {
        return $this->geoData;
    }
}
