<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AircraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aircrafts')->insert(array(['airline_id' => 1, 'type' => 'Boeing 737'], ['airline_id' => 1, 'type' => 'Airbus 320'], ['airline_id' => 1, 'type' => 'Boeing 747']));
    }
}
