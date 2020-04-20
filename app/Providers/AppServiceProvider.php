<?php

namespace App\Providers;

use App\WeatherForecast\WeatherForecastService;
use App\WeatherForecast\WeatherForecastServiceContract;
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
        $this->app->bind(WeatherForecastServiceContract::class, function($app) {
            return new WeatherForecastService();
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
