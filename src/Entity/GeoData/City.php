<?php

namespace App\Entity\GeoData;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class City
{
    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $cityRus;

    /**
     * @ORM\Column(type="integer")
     */
    private $zipCode;

    public function __construct(string $city, string $cityRus, int $zipCode)
    {
        $this->city = $city;
        $this->cityRus = $cityRus;
        $this->zipCode = $zipCode;
    }

    public function getName(): string
    {
        return $this->city;
    }

    public function getNameRus(): string
    {
        return $this->cityRus;
    }

    public function getZipCode(): int
    {
        return $this->zipCode;
    }
}
