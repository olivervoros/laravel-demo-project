<?php

namespace App\Repositories;

use App\Crew;
use App\Flight;

interface FlightRepositoryInterface
{
    public function getAll();

    public function saveFlight(array $flightData);

    public function modifyFlightData(int $flightId, array $flightData);

    public function deleteFlight(int $flightId);

    public function getFlightByFlightNumber($flightNumber);

    public function assignCrewToFlight(Crew $crew, Flight $flight);

    public function removeCrewFromFlight(Crew $crew, Flight $flight);

    public function getFlightById(int $flightId);

    public function getDelayedFlights();

    public function getOnTimeFlights();
}
