<?php

namespace App\Providers;

use App\Weather\WeatherForecast;
use App\Weather\WeatherForecastContract;
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
        $this->app->bind(WeatherForecastContract::class, function($app) {
            return new WeatherForecast('Budapest');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
