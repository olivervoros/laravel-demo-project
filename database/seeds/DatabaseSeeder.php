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
        $this->call(BaseSeeder::class);
        $this->call(CrewSeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(SchedulablesSeeder::class);
        $this->call(CrewRoleSeeder::class);
        $this->call(CrewFlightSeeder::class);
    }
}
