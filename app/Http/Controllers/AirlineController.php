<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AirlineController extends Controller
{

    public function index() {

        // 1, ONE-TO_ONE: Airline has one HQ

        // 2, ONE-TO-MANY: Aircraft has many Flights

        // 3, MANY-TO-MANY: Crew has many flights and flights has many crew

        // 4, HAS-ONE-THROUGH Airline has one HQ and HQ has one address

        // 5, HAS-MANY-THROUGH Airline has one HQ and HQ has many ground staff

        // 6, POLYMORPHIC ONE-TO-ONE GroundCrew has certification and Crew safety certification

        // 7, POLYMORPHIC ONE-TO-MANY CREW has logs and Aircraft has logs too

        // 8, POLYMORPHIC MANY-TO-MANY crews have many flights, flights have many crews and both have many schedules
    }
}


