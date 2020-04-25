<?php


namespace App;


use App\Events\FlightCancelledEvent;
use App\Events\FlightDepartedEvent;
use App\Events\FlightDepartedLateEvent;
use Illuminate\Support\Str;

class FlightInfoEventGenerator
{

    public function generateFlightInfoEvent() {
        $random_number = random_int(1, 100);
        $flightNumber = random_int(100, 999);
        $airlineCode = strtoupper(Str::generateRandomAlphabets(3));
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
}
