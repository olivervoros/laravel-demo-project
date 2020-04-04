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
        $now = date('Y-m-d H:i:s');
        DB::table('roles')->insert(array(['role' => 'Captain', 'created_at' => $now, 'updated_at' => $now], ['role' => 'First Officer', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'Cabin Crew', 'created_at' => $now, 'updated_at' => $now], ['role' => 'Senior Cabin Crew', 'created_at' => $now, 'updated_at' => $now], ['role' => 'Engineer', 'created_at' => $now, 'updated_at' => $now]));
    }
}
