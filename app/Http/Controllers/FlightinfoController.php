<?php

namespace App\Http\Controllers;

use App\Events\FlightCancelledEvent;
use App\Events\FlightDepartedEvent;
use App\Events\FlightDepartedLateEvent;
use App\FlightInfoEventGenerator;
use Illuminate\Http\Request;

class FlightinfoController extends Controller
{

    public function fire(FlightInfoEventGenerator $flightInfoEventGenerator) {
        for ($x = 0; $x <= 20; $x++) {
            sleep(10);
            $event = $flightInfoEventGenerator->generateFlightInfoEvent();
            event($event);
        }

    }

}
