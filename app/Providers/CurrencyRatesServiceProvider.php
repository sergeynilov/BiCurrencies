<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\CurrencyRatesFunctionality;

class CurrencyRatesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\CurrencyRatesFunctionality', function ($app) {
            return new CurrencyRatesFunctionality();
        });
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

    public function provides() {
        return CurrencyRatesFunctionality::class;
    }
}
