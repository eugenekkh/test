<?php

namespace App\Entity\GeoData;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Country
{
    /**
     * @ORM\Column(type="string")
     */
    private $countryCode;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @ORM\Column(type="string")
     */
    private $countryRus;

    public function __construct(string $countryCode, string $country, string $countryRus)
    {
        $this->countryCode = $countryCode;
        $this->country = $country;
        $this->countryRus = $countryRus;
    }

    public function getCode(): string
    {
        return $this->countryCode;
    }

    public function getName(): string
    {
        return $this->country;
    }

    public function getNameRus(): string
    {
        return $this->countryRus;
    }
}
