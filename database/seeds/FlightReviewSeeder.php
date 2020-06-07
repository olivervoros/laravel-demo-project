<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flightreviews')->truncate();
        factory(App\Flightreview::class, 1000)->create();
    }
}
