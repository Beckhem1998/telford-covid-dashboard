<?php

namespace App\Repository\GovAPI;

use Illuminate\Support\Facades\Cache;

/**
 * Class CacheGovAPIRepository
 *
 * @package App\Repository\GovAPI
 */
class CacheGovAPIRepository implements GovAPIRepository
{
    /**
     * Gov Rest API Repository
     *
     * @var RestGovAPIRepository $restRepository
     */
    protected RestGovAPIRepository $restRepository;

    /**
     * CacheGovAPIRepository constructor.
     *
     * @param RestGovAPIRepository $restRepository
     *
     * @return void
     */
    public function __construct(RestGovAPIRepository $restRepository)
    {
        $this->restRepository = $restRepository;
    }

    /**
     * Get all the Covid stats from the Govs API
     *
     * @param string $endpoint - Gov API endpoint
     *
     * @return string
     */
    public function show(string $endpoint): string
    {
        return Cache::remember('gov_api', 1800, function () use ($endpoint) {
            return $this->restRepository->show($endpoint);
        });
    }
}
