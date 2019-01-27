<?php

namespace App\Entity\GeoData;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class GeoData
{
    /**
     * @var Country
     *
     * @ORM\Embedded(class = "App\Entity\GeoData\Country")
     */
    private $country;

    /**
     * @var Region
     *
     * @ORM\Embedded(class = "App\Entity\GeoData\Region")
     */
    private $region;

    /**
     * @var City
     *
     * @ORM\Embedded(class = "App\Entity\GeoData\City")
     */
    private $city;

    /**
     * @var Coordinates
     *
     * @ORM\Embedded(class = "App\Entity\GeoData\Coordinates")
     */
    private $coordinates;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $timeZone;

    public function __construct(Country $country, Region $region, City $city, Coordinates $coordinates, string $timeZone)
    {
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->coordinates = $coordinates;
        $this->timeZone = $timeZone;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }
}
