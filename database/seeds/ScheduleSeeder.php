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
        DB::table('schedules')->insert(array(['description' => 'Flight to Rome', 'created_at' => $now, 'updated_at' => $now], ['description' => 'Flight to New York', 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Flight to Buenos Aires', 'created_at' => $now, 'updated_at' => $now], ['description' => 'Flight to Warsaw', 'created_at' => $now, 'updated_at' => $now]));
    }
}
