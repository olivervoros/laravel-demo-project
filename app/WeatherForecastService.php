<?php


namespace App;


class WeatherForecastService
{

    private $weatherConditions = array();

    /**
     * WeatherForecastService constructor.
     * @param array $weatherConditions
     */
    public function __construct(array $weatherConditions)
    {
        $this->weatherConditions = $weatherConditions;
    }


    public function getWeatherForecast(string $city = 'Budapest'): string {

        $randomKey = array_rand($this->weatherConditions, 1);
        $todayWeather = $this->weatherConditions[$randomKey];

        dd("The weather today in ".ucfirst($city)." is $todayWeather...");
    }


}
