<?php

namespace App\Weather;

interface WeatherForecastContract
{
    public function getForecast(string $city):string;
}
