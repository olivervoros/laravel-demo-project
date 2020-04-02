<?php


namespace App;

// This is our Facade Class
class WeatherForecast
{

    protected static function resolveFacade($name) {

        return app()[$name];

    }

    public static  function __callStatic($method, $arguments) {

        return self::resolveFacade('WeatherForecast')->$method(...$arguments);

    }

}
