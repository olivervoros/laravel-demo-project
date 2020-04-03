<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('airlines')->insert(['baseId' => 2, 'name' => 'Eloquent Airline', 'created_at' => $now, 'updated_at' => $now]);
    }
}
