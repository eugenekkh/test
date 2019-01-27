<?php

namespace App\Entity\GeoData;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Region
{
    /**
     * @ORM\Column(type="string")
     */
    private $region;

    /**
     * @ORM\Column(type="string")
     */
    private $regionRus;

    public function __construct(string $region, string $regionRus)
    {
        $this->region = $region;
        $this->regionRus = $regionRus;
    }

    public function getName(): string
    {
        return $this->region;
    }

    public function getNameRus(): string
    {
        return $this->regionRus;
    }
}
