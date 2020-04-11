<?php

namespace App\Http\Controllers;

use App\Notifications\WeatherForecastNotification;
use App\User;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function send($userId, $city = 'London') {

        $user = User::findOrFail($userId);
        $weatherForecast = $this->getForecast($city);
        $user->notify(new WeatherForecastNotification($weatherForecast));

        dd("Notification ha been sent to: ".$user->name);

    }

    public function onDemand($city = 'London') {

        $weatherForecast = $this->getForecast($city);

        Notification::route('mail', 'taylor@example.com')
            ->route('nexmo', '5555555555')
            ->route('slack', 'https://hooks.slack.com/services/...')
            ->notify(new WeatherForecastNotification($weatherForecast));
    }

    private function getForecast(string $city):string {
        $weatherConditions = array('Sunny', 'Rainy', 'Cloudy', 'Fair', 'Showery', 'Foggy');
        $randomKey = array_rand($weatherConditions, 1);
        $todayWeather = $weatherConditions[$randomKey];

        return "The weather today in ".ucfirst($city)." is $todayWeather.";
    }

}
