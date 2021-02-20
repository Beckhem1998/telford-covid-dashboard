<?php

namespace App\Repository\GovAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class RestGovAPIRepository
 *
 * @package App\Repository\GovAPI
 */
class RestGovAPIRepository implements GovAPIRepository
{
    /**
     * Guzzle Client
     *
     * @var Client $client
     */
    private Client $client;

    /**
     * GovAPIService constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get all the Covid stats from the Govs API
     *
     * @param string $endpoint - Gov API endpoint
     *
     * @throws GuzzleException
     *
     * @return string
     */
    public function show(string $endpoint): string
    {
        $response = $this->client->get($endpoint);

        return $response->getBody()->getContents();
    }
}
