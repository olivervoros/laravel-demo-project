<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('addresses')->insert(array(['headquaters_id' => 3, 'address' => 'Coding Street 1', 'created_at' => $now, 'updated_at' => $now], ['headquaters_id' => 1, 'address' => 'Laravel Avenue 99', 'created_at' => $now, 'updated_at' => $now]));
    }
}
