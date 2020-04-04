<?php

namespace App\Http\Controllers;

use App\Weather\WeatherForecast;
use Illuminate\Http\Request;

class WeatherForecastController extends Controller
{

    public function index(WeatherForecast $weatherForecastService, string $city = 'Budapest') {

        return $weatherForecastService->getForecast($city);

    }
}
