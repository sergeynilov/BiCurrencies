<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Library\Services\DateFunctionality;

class DateFunctionalityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //   php artisan make:provider DateFunctionalityServiceProvider
//                \Log::info('-12 DateFunctionalityServiceProvider ::' . print_r(-12, true));
        $this->app->bind('App\Library\Services\DateFunctionality', function ($app) {
//            \Log::info('-13 DateFunctionalityServiceProvider ::' . print_r(-13, true));
            return new DateFunctionality();
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
}
