<?php

namespace App\Http\Controllers;

use App\Aircraft;
use App\Airline;
use App\Crew;
use App\Flight;
use App\Log;
use App\SafetyCertification;
use App\Schedule;
use Illuminate\Http\Request;

class AirlineController extends Controller
{

    // 1, ONE-TO_ONE: Airline has one HQ
    public function oneToOne() {
        return Airline::find(1)->headquaters->hq;
    }

    // 2, ONE-TO-MANY: Aircraft has many Flights
    public function oneToMany() {
        //return Aircraft::find(3)->flights;

        return Aircraft::find(3)->flights()->where('flight_number', 110)->first();
    }

    // 3, MANY-TO-MANY: Crew has many flights and flights has many crew
    public function manyToMany() {
        $flight = Flight::find(2);

        $result = '';
        foreach ($flight->crew as $crew) {
            $result .= "NAME: $crew->name CREATED AT: {$crew->pivot->created_at}"."</br>";
        }

        return $result;
    }

    // 4, HAS-ONE-THROUGH Airline has one HQ and HQ has one address
    public function hasOneThrough() {
        return Airline::find(1)->headquaters->address->address;
    }

    // 5, HAS-MANY-THROUGH Airline has one HQ and HQ has many ground staff
    public function hasManyThrough() {
        return Airline::find(1)->headquaters->groundCrew;
    }

    // 6, POLYMORPHIC ONE-TO-ONE GroundCrew has one safety certification and Crew has one safety certification
    public function polymorphicOneToOne() {

        return Crew::find(2)->safetyCertification;

        //$certificate = SafetyCertification::find(1);
        //return $certificate->certificationable;
    }

    // 7, POLYMORPHIC ONE-TO-MANY CREW has logs and Aircraft has logs too
    public function polymorphicOneToMany()
    {
        return Aircraft::find(2)->logs;

        //return Crew::find(1)->logs;

        //return  Log::find(2)->loggable; // App\Crew
        //return Log::find(3)->loggable; // App\Aircraft
    }

    // 8, POLYMORPHIC MANY-TO-MANY crews have many flights, flights have many crews and both have many schedules
    public function polymorphicManyToMany() {

        //return Flight::find(2)->crews;

        //return Crew::find(1)->flights;

        //return Schedule::find(2)->crews; // App\Crew

        return Schedule::find(2)->flights; // App\Flight


    }

}


