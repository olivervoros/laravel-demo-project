<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crews')->insert(array(['name' => 'Mary'], ['name' => 'Sylvia'], ['name' => 'Brian'], ['name' => 'Tracy']));
    }
}
