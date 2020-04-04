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
        $now = date('Y-m-d H:i:s');
        DB::table('aircrafts')->insert(array(['airline_id' => 1, 'type' => 'Boeing 737', 'created_at' => $now, 'updated_at' => $now], ['airline_id' => 1, 'type' => 'Airbus 320', 'created_at' => $now, 'updated_at' => $now], ['airline_id' => 1, 'type' => 'Boeing 747', 'created_at' => $now, 'updated_at' => $now]));
    }
}
