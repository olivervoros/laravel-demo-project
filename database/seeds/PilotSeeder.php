<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('pilots')->insert(array(['name' => 'Jason', 'created_at' => $now, 'updated_at' => $now], ['name' => 'Jeremy', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Steven', 'created_at' => $now, 'updated_at' => $now], ['name' => 'Jack', 'created_at' => $now, 'updated_at' => $now], ['name' => 'Paul', 'created_at' => $now, 'updated_at' => $now]));
    }
}
