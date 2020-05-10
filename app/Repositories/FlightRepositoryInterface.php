<?php


namespace App\Repositories;

interface FlightRepositoryInterface
{
    public function getAll();
    public function saveFlight(array $flightData);
    public function getOnTimeFlights();
    public function getDelayedFlights();
    public function getFlightById(int $flightId);
    public function getFlightByFlightNumber(string $flightNumber);
}
