<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(['id' => 1, 'role' => 'Admin'], ['id' => 2, 'role' => 'Author'], ['id' => 3, 'role' => 'Guest']));
    }
}
