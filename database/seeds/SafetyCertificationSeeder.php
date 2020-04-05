<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SafetyCertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('safety_certifications')->insert(array(['certification_code' => 'SdygB67wrb3egvPKge3P', 'certificationable_id' => 2, 'certificationable_type' => 'App/Crew', 'created_at' => $now, 'updated_at' => $now], ['certification_code' => 'UHvhdX6eaNtd99Hcz39J', 'certificationable_id' => 2, 'certificationable_type' => 'App/GroundCrew', 'created_at'=>  $now, 'updated_at' => $now]));
    }
}
