<?php


namespace App\Weather;


class WeatherForecast implements WeatherForecastContract
{

    public function getForecast(string $city):string {
        $weatherConditions = array('Sunny', 'Rainy', 'Cloudy', 'Fair', 'Showery', 'Foggy');
        $randomKey = array_rand($weatherConditions, 1);
        $todayWeather = $weatherConditions[$randomKey];

        return "The weather today in ".ucfirst($city)." is $todayWeather...";
    }

}
