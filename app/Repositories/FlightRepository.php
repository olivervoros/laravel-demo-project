<?php


namespace App\Repositories;

use App\Crew;
use App\Flight;
use Illuminate\Support\Facades\DB;

class FlightRepository implements FlightRepositoryInterface
{

    public function getAll() {
        return DB::select('select * from flights');
    }

    public function saveFlight(array $flightData)
    {
        $insertedId =  DB::table('flights')->insertGetId($flightData);
        return Flight::find($insertedId);
    }

    public function modifyFlightData(int $flightId, array $flightData)
    {
        $arrayToUpdate = [
            'flightNumber' => $flightData['flightNumber'],
            'estimatedTimeOfDeparture' => $flightData['estimatedTimeOfDeparture'],
            'estimatedTimeOfArrival' => $flightData['estimatedTimeOfArrival'],
            'departureAirport' =>  $flightData['departureAirport'],
            'arrivalAirport' => $flightData['arrivalAirport'],
            'delay' => $flightData['delay']];

        DB::table('flights')->where('id', $flightId)->update($arrayToUpdate);
        return Flight::find($flightId);
    }

    public function deleteFlight(int $flightId)
    {
        DB::table('flights')->where('id', $flightId)->delete();
    }

    public function getFlightByFlightNumber($flightNumber)
    {
       return DB::table('flights')->where('flightNumber', $flightNumber)->get()->first();
    }

    public function assignCrewToFlight(Crew $crew, Flight $flight)
    {
        $flight->crews()->attach($crew);
    }

    public function removeCrewFromFlight(Crew $crew, Flight $flight)
    {
        $flight->crews()->detach($crew);
    }

    public function getFlightById(int $flightId)
    {
        return DB::select('select * from flights where id = ?', [$flightId]);
    }

    public function TODOgetFlightByFlightNumber(string $flightNumber)
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
