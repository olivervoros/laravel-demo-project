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
        $now = date('Y-m-d H:i:s');
        DB::table('crew_flight')->insert(array(['crew_id' => 1, 'flight_id' => 2, 'created_at' => $now, 'updated_at' => $now], ['crew_id' => 2, 'flight_id' => 2, 'created_at' => $now, 'updated_at' => $now], ['crew_id' => 3, 'flight_id' => 2, 'created_at' => $now, 'updated_at' => $now], ['crew_id' => 4, 'flight_id' => 2, 'created_at' => $now, 'updated_at' => $now]));
    }
}
