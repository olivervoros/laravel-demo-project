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
        DB::table('flights')->insert(array(['aircraft_id' => 3, 'name' => 'Flight to London', 'flight_number' => 610, 'date' => 'April 10 9:00 2019'], ['aircraft_id' => 1, 'name' => 'Flight to Paris', 'flight_number' => 520, 'date' => 'April 10 11:30 2019'], ['aircraft_id' => 3, 'name' => 'Flight to Tokyo', 'flight_number' => 110, 'date' => 'April 10 14:15 2019'], ['aircraft_id' => 2, 'name' => 'Flight to Barcelona', 'flight_number' => 480 , 'date' => 'April 10 18:00 2019']));
    }
}
