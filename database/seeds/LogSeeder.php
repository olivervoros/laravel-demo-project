<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert(array(
            ['log' => '2019-03-22 flight number 345', 'minutes_flown' => '180', 'loggable_id' => 1, 'loggable_type' => 'App\Crew'],
            ['log' => '2019-03-22 flight number 345', 'minutes_flown' => '180', 'loggable_id' => 2, 'loggable_type' => 'App\Crew'],
            ['log' => '2019-03-22 flight number 345', 'minutes_flown' => '180', 'loggable_id' => 2, 'loggable_type' => 'App\Aircraft']
        ));
    }
}
