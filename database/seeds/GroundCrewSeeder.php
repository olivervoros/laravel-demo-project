<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroundCrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('ground_crews')->insert(array(['headquaters_id' => 1, 'name' => 'John', 'created_at' => $now, 'updated_at' => $now], ['headquaters_id' => 1, 'name' => 'Susan', 'created_at' => $now, 'updated_at' => $now]));
    }
}
