<?php

namespace App\Tests\Normalizer;

use App\Entity\GeoData\GeoData;
use App\Normalizer\GeoDataDenormalizer;
use PHPUnit\Framework\TestCase;

class GeoDataDenormalizerTest extends TestCase
{
    public function testDenormalizer(): void
    {
        $denormalizer = new GeoDataDenormalizer();

        $testData = [
            'ip' => '8.8.8.8',
            'country_code' => 'US',
            'country' => 'United states',
            'country_rus' => 'США',
            'region' => 'California',
            'region_rus' => 'Калифорния',
            'city' => 'Mountain view',
            'city_rus' => 'Маунтин-Вью',
            'latitude' => '37.405992',
            'longitude' => '-122.078515',
            'zip_code' => '94043',
            'time_zone' => '-08:00',
        ];

        $this->assertInstanceOf(GeoData::class, $denormalizer->denormalize($testData, GeoData::class));
    }
}
