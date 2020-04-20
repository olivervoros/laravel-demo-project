<?php


namespace App\WeatherForecast;


class WeatherForecastService implements WeatherForecastServiceContract
{

    public function getForecast(string $city = "Budapest"):string {
        $weatherConditions = array('Sunny', 'Rainy', 'Cloudy', 'Fair', 'Showery', 'Foggy');
        $randomKey = array_rand($weatherConditions, 1);
        $todayWeather = $weatherConditions[$randomKey];

        return "The weather today in ".ucfirst($city)." is $todayWeather.";
    }

}
