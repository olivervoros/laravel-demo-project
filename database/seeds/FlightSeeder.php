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
        $now = date('Y-m-d H:i:s');
        DB::table('flights')->insert(array(['aircraft_id' => 3, 'name' => 'Flight to London', 'created_at' => $now, 'updated_at' => $now], ['aircraft_id' => 1, 'name' => 'Flight to Paris', 'created_at' => $now, 'updated_at' => $now], ['aircraft_id' => 3, 'name' => 'Flight to Tokyo', 'created_at' => $now, 'updated_at' => $now], ['aircraft_id' => 2, 'name' => 'Flight to Barcelona', 'created_at' => $now, 'updated_at' => $now]));
    }
}
