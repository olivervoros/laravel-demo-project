<?php

use Illuminate\Support\Facades\Route;
use App\WeatherForecastService;
use App\WeatherForecast;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/weather/{city}', function ($city) {

    $weatherConditions = array('Sunny', 'Rainy', 'Cloudy', 'Fair', 'Showery', 'Foggy');
    $weatherForecastService = new WeatherForecastService($weatherConditions);
    $weatherForecastService->getWeatherForecast($city);

});

Route::get('/weather-facade/{city}', function ($city) {

    WeatherForecast::getWeatherForecast($city);

});
