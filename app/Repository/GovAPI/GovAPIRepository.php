<?php

namespace App\Repository\GovAPI;

/**
 * Interface GovAPIRepository
 *
 * @package App\Repository\GovAPI
 */
interface GovAPIRepository
{
    /**
     * Get all the Covid stats from the Govs API
     *
     * @param string $endpoint - Gov API endpoint
     *
     * @return string
     */
    public function show(string $endpoint): string;
}
