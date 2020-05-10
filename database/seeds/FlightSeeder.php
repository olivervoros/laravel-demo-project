<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flights = array();
        $flights[] = ['flightNumber' => 'MA610', 'estimatedTimeOfDeparture' => '10:00', 'estimatedTimeOfArrival' => '12:00', 'departureAirport' => 'Budapest', 'arrivalAirport' => 'London', 'delay' => 20];
        $flights[] = ['flightNumber' => 'MA610', 'estimatedTimeOfDeparture' => '10:00', 'estimatedTimeOfArrival' => '22:00', 'departureAirport' => 'London/Heathrow', 'arrivalAirport' => 'Tokyo', 'delay' => 0];
        $flights[] = ['flightNumber' => 'WZZ235', 'estimatedTimeOfDeparture' => '08:15', 'estimatedTimeOfArrival' => '11:00', 'departureAirport' => 'Warsaw', 'arrivalAirport' => 'Tel Aviv', 'delay' => 45];
        $flights[] = ['flightNumber' => 'LH110', 'estimatedTimeOfDeparture' => '21:00', 'estimatedTimeOfArrival' => '23:50', 'departureAirport' => 'Frankfurt', 'arrivalAirport' => 'Istanbul', 'delay' => 0];
        $flights[] = ['flightNumber' => 'AF470', 'estimatedTimeOfDeparture' => '10:00', 'estimatedTimeOfArrival' => '23:00', 'departureAirport' => 'Paris', 'arrivalAirport' => 'New York', 'delay' => 0];

        DB::table('flights')->insert($flights);
    }
}
