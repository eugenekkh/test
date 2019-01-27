<?php

namespace App\Provider;

use App\Entity\GeoData\GeoData;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface as SerializerException;

class IpUaProvider implements GeoDataProviderInterface
{
    const API_URL = 'https://api.2ip.ua/geo.json';
    const HTTP_SUCCESS = 200;

    private $client;
    private $logger;
    private $serializer;

    public function __construct(SerializerInterface $serializer, LoggerInterface $logger, int $timeout = 5)
    {
        $this->serializer = $serializer;
        $this->logger = $logger;

        $this->client = new GuzzleClient([
            'timeout'  => $timeout,
        ]);
    }

    public function getGeoData(string $ip): GeoData
    {
        return $this->deserialize($this->getData($ip));
    }

    private function getData(string $ip): string
    {
        try {
            $url = sprintf('%s?ip=%s', static::API_URL, $ip);

            $this->logger->debug(sprintf('Make request %s', $url));

            $response = $this->client->get($url);

            if (static::HTTP_SUCCESS != $response->getStatusCode()) {
                throw new Exception(sprintf('Bad answer code %s', $response->getStatusCode()));
            }

            return $response->getBody();
        } catch (GuzzleException $e) {
            $this->logger->error('Error receive data from 2ip.ua');
            throw $e;
        }
    }

    private function deserialize(string $data): GeoData
    {
        try {
            return $this->serializer->deserialize($data, GeoData::class, 'json');
        } catch (SerializerException $e) {
            $this->logger->error('Error deserialize data from 2ip.ua');
            throw $e;
        }
    }
}
