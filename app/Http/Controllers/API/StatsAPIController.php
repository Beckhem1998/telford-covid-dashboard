<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CovidStatsService;

/**
 * Class StatsAPIController
 *
 * @package App\Http\Controllers\API
 */
class StatsAPIController extends Controller
{
    /**
     * Covid Stats Service
     *
     * @var CovidStatsService $service
     */
    protected CovidStatsService $service;

    /**
     * StatsAPIController constructor.
     *
     * @param CovidStatsService $service - Covid Stats Service
     *
     * @return void
     */
    public function __construct(CovidStatsService $service)
    {
        $this->service = $service;
    }

    /**
     * Display the specified resource.
     *
     * @return array
     */
    public function show(): array
    {
        return $this->service->getStats();
    }
}
