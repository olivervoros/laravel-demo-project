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
        DB::table('schedules')->insert(array(['description' => 'Flight to Rome'], ['description' => 'Flight to New York'],
            ['description' => 'Flight to Buenos Aires'], ['description' => 'Flight to Warsaw']));
    }
}
