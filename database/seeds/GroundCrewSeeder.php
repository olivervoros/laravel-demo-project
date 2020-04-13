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
        DB::table('ground_crews')->insert(array(['headquaters_id' => 1, 'name' => 'John'], ['headquaters_id' => 1, 'name' => 'Susan']));
    }
}
