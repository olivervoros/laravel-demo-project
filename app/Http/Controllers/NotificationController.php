<?php

namespace App\Http\Controllers;

use App\Notifications\WeatherForecastNotification;
use App\User;
use App\WeatherForecast\WeatherForecastService;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{

    public function send(WeatherForecastService $weatherForecastService, $userId, $city = 'London') {

        $user = User::findOrFail($userId);
        $weatherForecast = $weatherForecastService->getForecast($city);
        $user->notify(new WeatherForecastNotification($weatherForecast));

        dd("Notification ha been sent to: ".$user->name);

    }

    public function onDemand(WeatherForecastService $weatherForecastService, $city = 'London') {

        $weatherForecast = $weatherForecastService->getForecast($city);

        Notification::route('mail', 'taylor@example.com')
            ->route('nexmo', '5555555555')
            ->route('slack', 'https://hooks.slack.com/services/...')
            ->notify(new WeatherForecastNotification($weatherForecast));
    }

}
