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
        $this->call(AircraftSeeder::class);
        $this->call(AirlineSeeder::class);
        $this->call(HeadquatersSeeder::class);
        $this->call(CrewSeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(SchedulablesSeeder::class);
        $this->call(CrewFlightSeeder::class);
        $this->call(LogSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(GroundCrewSeeder::class);
        $this->call(SafetyCertificationSeeder::class);
    }
}
