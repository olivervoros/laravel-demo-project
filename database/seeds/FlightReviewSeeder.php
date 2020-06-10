<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FlightReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::table('flightreviews')->truncate();
        factory(App\Flightreview::class, 1000)->create();

        $airlines = array("British Airways", "Lufthansa", "Air France", "KLM", "Iberia");
        $extraReviews = array();
        for ($x = 1; $x < 18; $x++) {
            $array = [
                'id' => (9000 + $x),
                'passenger_id' => 999,
                'airline' => Arr::random($airlines),
                'flight_number' => random_int(1, 1000),
                'review_points' => random_int(1, 10),
                'review_title' => "Example Title $x",
                'review_body' => "$x Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum"
            ];
            $extraReviews[] = $array;
        }
        DB::table('flightreviews')->insert($extraReviews);
    }
}
