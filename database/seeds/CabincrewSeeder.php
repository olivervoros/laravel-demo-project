<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabincrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('cabincrews')->insert(array(['name' => 'Mary', 'created_at' => $now, 'updated_at' => $now], ['name' => 'Sylvia', 'created_at' => $now, 'updated_at' => $now], ['name' => 'Brian', 'created_at' => $now, 'updated_at' => $now], ['name' => 'Tracy', 'created_at' => $now, 'updated_at' => $now]));
    }
}
