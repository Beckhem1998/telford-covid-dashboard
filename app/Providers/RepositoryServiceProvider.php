<?php

namespace App\Providers;

use App\Repository\GovAPI\CacheGovAPIRepository;
use App\Repository\GovAPI\GovAPIRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GovAPIRepository::class, CacheGovAPIRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
