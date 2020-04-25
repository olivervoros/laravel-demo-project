<?php

namespace App\Http\Controllers;

use App\Events\FlightCancelledEvent;
use App\Events\FlightDepartedEvent;
use App\Events\FlightDepartedLateEvent;
use Illuminate\Http\Request;

class FlightinfoController extends Controller
{

    public function fire() {
        for ($x = 0; $x <= 20; $x++) {
            $randomSleep = random_int(5, 10);
            sleep($randomSleep);
            $event = $this->generateEvent();
            event($event);
        }

    }

    private function generateEvent() {
        $random_number = random_int(1, 100);
        $flightNumber = random_int(100, 999);
        $airlineCode = strtoupper($this->generateRandomString(3));
        $delayMinutes = random_int(30, 120);
        $destinations = ['Budapest', 'London', 'Barcelona', 'Rome', 'Frankfurt', 'Berlin', 'Warsaw', 'Wien', 'Madrid', 'Helsinki'];
        $randomDestination = $destinations[array_rand($destinations)];

        $flightCode = "$airlineCode-$flightNumber";

        if($random_number > 90) {
            return new FlightCancelledEvent($flightCode, $randomDestination);
        } elseif($random_number > 70) {
            return new FlightDepartedLateEvent($flightCode, $randomDestination, $delayMinutes);
        } else {
            return new FlightDepartedEvent($flightCode, $randomDestination);
        }
    }

    private function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
