<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('crew_role')->insert(array(['crew_id' => 1, 'role_id' => 3, 'created_at' => $now, 'updated_at' => $now], ['crew_id' => 2, 'role_id' => 3, 'created_at' => $now, 'updated_at' => $now], ['crew_id' => 3, 'role_id' => 1, 'created_at' => $now, 'updated_at' => $now], ['crew_id' => 4, 'role_id' => 2, 'created_at' => $now, 'updated_at' => $now]));
    }
}
