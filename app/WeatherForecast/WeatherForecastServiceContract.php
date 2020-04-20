<?php

namespace App\WeatherForecast;

interface WeatherForecastServiceContract
{
    public function getForecast(string $city): string;
}
