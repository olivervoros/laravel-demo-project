<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeatherLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('weather_logs')->insert(array(['log' => 'The weather in Paris is sunny', 'created_at' => $now, 'updated_at' => $now], ['log' => 'The weather in London is rainy', 'created_at' => $now, 'updated_at' => $now], ['log' => 'The weather in Tokyo is fair', 'created_at' => $now, 'updated_at' => $now], ['log' => 'The weather in Budapest is Stormy', 'created_at' => $now, 'updated_at' => $now]));
    }
}
