<?php


namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FlightRepository implements FlightRepositoryInterface
{

    public function getAll() {
        return DB::select('select * from flights');
    }

    public function saveFlight(array $flightData)
    {
        if(!empty($flightData['flightNumber'])) {
           return DB::table('flights')->insertGetId($flightData);
        }
    }

    public function getFlightById(int $flightId)
    {
        return DB::select('select * from flights where id = ?', [$flightId]);
    }

    public function getFlightByFlightNumber(string $flightNumber)
    {
        return DB::select('select * from flights where flightNumber = ?', [$flightNumber]);
    }

    public function getDelayedFlights() {
        return DB::select('select * from flights where delay > ?', [0]);
    }

    public function getOnTimeFlights() {
        return DB::select('select * from flights where delay = ?', [0]);
    }

}
