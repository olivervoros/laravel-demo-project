<?php

use Illuminate\Database\Seeder;

class FlightReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Flightreview::class, 1000)->create();
    }
}
