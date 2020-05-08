<?php


namespace App;
use App\Crew;

class Flight
{
    private $flightNumber;
    private $estimatedTimeOfDeparture;
    private $estimatedTimeOfArrival;
    private $departureAirport;
    private $arrivalAirport;
    private $crew = [];

    const NUMBER_OF_PILOTS_ON_FLIGHT = 2;
    const NUMBER_OF_CABIN_CREW_ON_FLIGHT = 4;


    /**
     * Flight constructor.
     * @param $flightNumber
     * @param $estimatedTimeOfDeparture
     * @param $estimatedTimeOfArrival
     * @param $departureAirport
     * @param $arrivalAirport
     * @param array $crew
     */
    public function __construct(string $flightNumber, string $estimatedTimeOfDeparture, string $estimatedTimeOfArrival, string $departureAirport, string $arrivalAirport)
    {
        $this->flightNumber = $flightNumber;
        $this->estimatedTimeOfDeparture = $estimatedTimeOfDeparture;
        $this->estimatedTimeOfArrival = $estimatedTimeOfArrival;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
    }


    /**
     * @return string
     */
    public function getFlightNumber(): string
    {
        return $this->flightNumber;
    }

    /**
     * @param string $flightNumber
     */
    public function setFlightNumber(string $flightNumber): void
    {
        $this->flightNumber = $flightNumber;
    }

    /**
     * @return string
     */
    public function getEstimatedTimeOfDeparture(): string
    {
        return $this->estimatedTimeOfDeparture;
    }

    /**
     * @param string $estimatedTimeOfDeparture
     */
    public function setEstimatedTimeOfDeparture(string $estimatedTimeOfDeparture): void
    {
        $this->estimatedTimeOfDeparture = $estimatedTimeOfDeparture;
    }

    /**
     * @return string
     */
    public function getEstimatedTimeOfArrival(): string
    {
        return $this->estimatedTimeOfArrival;
    }

    /**
     * @param string $estimatedTimeOfArrival
     */
    public function setEstimatedTimeOfArrival(string $estimatedTimeOfArrival): void
    {
        $this->estimatedTimeOfArrival = $estimatedTimeOfArrival;
    }

    /**
     * @return string
     */
    public function getDepartureAirport(): string
    {
        return $this->departureAirport;
    }

    /**
     * @param string $departureAirport
     */
    public function setDepartureAirport(string $departureAirport): void
    {
        $this->departureAirport = $departureAirport;
    }

    /**
     * @return string
     */
    public function getArrivalAirport(): string
    {
        return $this->arrivalAirport;
    }

    /**
     * @param string $arrivalAirport
     */
    public function setArrivalAirport(string $arrivalAirport): void
    {
        $this->arrivalAirport = $arrivalAirport;
    }

    /**
     * @return array
     */
    public function getTotalCrew(): array
    {
        return $this->crew;
    }

    /**
     * @param Crew $crew
     * @throws \Exception
     */
    public function addCrew(Crew $crew): void
    {
        $this->validateFlightCrew($crew);
        $this->crew[] = $crew;
    }

    public function getCrewOnFlight() {
        $totalCrew = $this->getTotalCrew();
        $numPilots = 0;
        $numCabinCrews = 0;
        foreach($totalCrew as $crew) {
            if($crew->getPosition()==='pilot') {
                $numPilots++;
            }
            elseif($crew->getPosition()==='cabincrew') {
                $numCabinCrews++;
            }
            else {
                continue;
            }
        }

        return array('numPilots' => $numPilots, 'numCabinCrews' => $numCabinCrews);
    }

    protected function validateFlightCrew($crew) {
        $crewOnFlight = $this->getCrewOnFlight();

        if($crew->getPosition()==='pilot' && $crewOnFlight['numPilots'] === self::NUMBER_OF_PILOTS_ON_FLIGHT) {
            throw new \Exception("No more pilots needed...");
        }

        if($crew->getPosition()==='cabincrew' && $crewOnFlight['numCabinCrews'] === self::NUMBER_OF_CABIN_CREW_ON_FLIGHT) {
            throw new \Exception("No more cabin crew needed...");
        }

        return true;

    }

    public function isComplete()
    {
        $crewOnFlight = $this->getCrewOnFlight();

        return ((int)$crewOnFlight['numPilots']===2 && (int)$crewOnFlight['numCabinCrews']===4);
    }



}
