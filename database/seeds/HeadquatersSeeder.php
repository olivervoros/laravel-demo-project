<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeadquatersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('headquaters')->insert(array(['address_id' => 1, 'airline_id' => 1, 'hq' => 'London', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]));
    }
}
