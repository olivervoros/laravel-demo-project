<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('schedules')->insert(array(['flight_id' => 2, 'created_at' => $now, 'updated_at' => $now], ['flight_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['flight_id' => 4, 'created_at' => $now, 'updated_at' => $now], ['flight_id' => 3, 'created_at' => $now, 'updated_at' => $now]));
    }
}
