<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crew_flight')->insert(array(['crew_id' => 1, 'flight_id' => 2], ['crew_id' => 2, 'flight_id' => 2], ['crew_id' => 3, 'flight_id' => 2], ['crew_id' => 4, 'flight_id' => 2]));
    }
}
