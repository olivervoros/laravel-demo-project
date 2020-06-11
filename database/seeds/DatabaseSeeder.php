<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PassengerSeeder::class);
        $this->call(FlightReviewSeeder::class);
        exec('php artisan passport:client --personal --name="Oliver Voros"');
    }
}
