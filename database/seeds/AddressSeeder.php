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
        DB::table('addresses')->insert(array(['headquaters_id' => 3, 'address' => 'Coding Street 1'], ['headquaters_id' => 1, 'address' => 'Laravel Avenue 99']));
    }
}
