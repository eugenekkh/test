<?php

namespace App\Provider;

use App\Entity\GeoData\GeoData;

interface GeoDataProviderInterface
{
    public function getGeoData(string $ip): GeoData;
}
