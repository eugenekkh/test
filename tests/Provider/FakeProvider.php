<?php

namespace App\Tests\Provider;

use App\Entity\GeoData\GeoData;
use App\Provider\GeoDataProviderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class FakeProvider implements GeoDataProviderInterface
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getGeoData(string $ip): GeoData
    {
        $data = '{"ip":"'.$ip.'","country_code":"US","country":"United states","country_rus":"\u0421\u0428\u0410","region":"California","region_rus":"\u041a\u0430\u043b\u0438\u0444\u043e\u0440\u043d\u0438\u044f","city":"Mountain view","city_rus":"\u041c\u0430\u0443\u043d\u0442\u0438\u043d-\u0412\u044c\u044e","latitude":"37.405992","longitude":"-122.078515","zip_code":"94043","time_zone":"-08:00"}';

        return $this->deserialize($data);
    }

    private function deserialize(string $data): GeoData
    {
        return $this->serializer->deserialize($data, GeoData::class, 'json');
    }
}
