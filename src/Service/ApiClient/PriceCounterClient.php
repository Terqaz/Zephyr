<?php

namespace App\Service\ApiClient;

use App\Entity\Flight;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PriceCounterClient
{
    private readonly HttpClientInterface $api;

    public function __construct(
        private readonly HttpClientInterface $client,
        // private readonly JsonEncoder $encoder,
        private readonly string $baseUrl,
        // private readonly string $token,
    ) {
        $this->api = $client->withOptions([
            'base_uri' => $baseUrl,
            
            'headers' => [
                'Content-Type' => 'application/json'
                // 'Authorization' => 'Bearer ' . $token,
            ],
        ]);
    }

    /**
     * @param Flight[] $flights
     * @return float[]
     */
    public function getPrices(array $flights): array
    {
        $predictionsResponse = $this->api->request('POST', '/predict', [
            // 'body' => $flights
            'json' => $flights,
        ]);

        $predictionsResponse = $predictionsResponse->toArray();

        return $predictionsResponse['prediction'];
    }
}
