<?php

namespace App\Providers;

use App\WeatherForecastService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('WeatherForecast', function($app) {

            $weatherConditions = array('Sunny', 'Rainy', 'Cloudy', 'Fair', 'Showery', 'Foggy');
            return new WeatherForecastService( $weatherConditions);

        });
    }
}
