<?php


namespace App;


class Flight
{
    private $flightNumber;
    private $estimatedTimeOfDeparture;
    private $estimatedTimeOfArrival;
    private $departureAirport;
    private $arrivalAirport;
    private $crew = [];

    public function __construct(string $flightNumber, string $estimatedTimeOfDeparture, string $estimatedTimeOfArrival, string $departureAirport, string $arrivalAirport)
    {
        $this->flightNumber = $flightNumber;
        $this->estimatedTimeOfDeparture = $estimatedTimeOfDeparture;
        $this->estimatedTimeOfArrival = $estimatedTimeOfArrival;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
    }

    public function getFlightNumber() {
        return $this->flightNumber;
    }

    public function getEstimatedTimeOfDeparture() {
        return $this->estimatedTimeOfDeparture;
    }

    public function getEstimatedTimeOfArrival() {
        return $this->estimatedTimeOfArrival;
    }

    public function getDepartureAirport()
    {
        return $this->departureAirport;
    }

    public function getArrivalAirport()
    {
        return $this->arrivalAirport;
    }

}
