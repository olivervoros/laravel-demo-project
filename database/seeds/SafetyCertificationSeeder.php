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
        DB::table('safety_certifications')->insert(array(['certification_code' => 'SdygB67wrb3egvPKge3P', 'certificationable_id' => 2, 'certificationable_type' => 'App\Crew'], ['certification_code' => 'UHvhdX6eaNtd99Hcz39J', 'certificationable_id' => 2, 'certificationable_type' => 'App\GroundCrew']));
    }
}
