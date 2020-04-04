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
        $now = date('Y-m-d H:i:s');
        DB::table('schedulables')->insert(array(['schedulable_id' => 2, 'schedulable_type' => 'App/Crew', 'created_at' => $now, 'updated_at' => $now], ['schedulable_id' => 4, 'schedulable_type' => 'App/Flight', 'created_at'=>  $now, 'updated_at' => $now]));
    }
}
