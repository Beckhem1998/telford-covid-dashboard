<?php

namespace App\Services;

use App\Exceptions\EmptyResponse;

/**
 * Class CovidStatsService
 *
 * @package App\Services
 */
class CovidStatsService
{
    /**
     * Government API Service
     *
     * @var GovAPIService $govAPIService
     */
    protected GovAPIService $govAPIService;

    /**
     * CovidStatsService constructor.
     *
     * @param GovAPIService $govAPIService
     *
     * @return void
     */
    public function __construct(GovAPIService $govAPIService)
    {
        $this->govAPIService = $govAPIService;
    }

    /**
     * Get the stats from the Government API
     *
     * @throws EmptyResponse
     *
     * @return array
     */
    public function getStats(): array
    {
        return $this->govAPIService->fetch();
    }
}
