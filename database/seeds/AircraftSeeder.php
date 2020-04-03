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
        DB::table('aircrafts')->insert(array(['airlineId' => 1, 'aircraftType' => 'Boeing 737', 'created_at' => $now, 'updated_at' => $now], ['airlineId' => 1, 'aircraftType' => 'Airbus 320', 'created_at' => $now, 'updated_at' => $now], ['airlineId' => 1, 'aircraftType' => 'Boeing 747', 'created_at' => $now, 'updated_at' => $now]));
    }
}
