<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedulables')->insert(array(['schedule_id' => 2, 'schedulable_id' => 2, 'schedulable_type' => 'App\Crew'], ['schedule_id' => 2, 'schedulable_id' => 4, 'schedulable_type' => 'App\Flight']));
    }
}
