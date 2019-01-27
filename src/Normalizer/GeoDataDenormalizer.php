<?php

namespace App\Normalizer;

use App\Entity\GeoData\City;
use App\Entity\GeoData\Country;
use App\Entity\GeoData\GeoData;
use App\Entity\GeoData\Region;
use App\Entity\GeoData\Coordinates;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class GeoDataDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return new GeoData(
            $this->getCountry($data),
            $this->getRegion($data),
            $this->getCity($data),
            $this->getCoordinates($data),
            $data['time_zone']
        );
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return GeoData::class == $type;
    }

    private function getCountry(array &$data): Country
    {
        return new Country($data['country_code'], $data['country'], $data['country_rus']);
    }

    private function getRegion(array &$data): Region
    {
        return new Region($data['region'], $data['region_rus']);
    }

    private function getCity(array &$data): City
    {
        return new City($data['city'], $data['city_rus'], $data['zip_code']);
    }

    private function getCoordinates(array &$data): Coordinates
    {
        return new Coordinates($data['latitude'], $data['longitude']);
    }
}
