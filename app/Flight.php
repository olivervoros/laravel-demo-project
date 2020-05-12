<?php


namespace App;
use App\Exceptions\NumberOfCabinCrewExceededException;
use App\Exceptions\NumberOfPilotsExceededException;
use App\Repositories\FlightRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    private $flightData = [];
    private $crew = [];

    const NUMBER_OF_PILOTS_ON_FLIGHT = 2;
    const NUMBER_OF_CABIN_CREW_ON_FLIGHT = 4;

    public function crews()
    {
        return $this->belongsToMany('App\Crew');
    }

    /**
     * @return array
     */
    public function getFlightData(): array
    {
        return $this->flightData;
    }

    /**
     * @param FlightRepositoryInterface|null $repo
     * @param array $flightData
     * @return Flight
     */
    public function saveFlight(FlightRepositoryInterface $repo, array $flightData = array())
    {
        $this->flightData = $this->assignFlightData($flightData);
        $result = $repo->saveFlight($this->flightData);
        return is_null($result) ? $this : $result;
    }

    public function modifyFlight(FlightRepositoryInterface $repo, int $flightId, array $flightData = array())
    {
        $this->flightData = $this->assignFlightData($flightData);
        $result = $repo->modifyFlightData($flightId, $this->flightData);
        return is_null($result) ? $this : $result;
    }

    public function deleteFlight(FlightRepositoryInterface $repo, int $flightId)
    {
        $result = $repo->deleteFlight($flightId);
        return is_null($result) ? $this : $result;
    }

    public function getFlightByFlightNumber(FlightRepositoryInterface $repo, $flightNumber)
    {
        $result = $repo->getFlightByFlightNumber($flightNumber);
        return is_null($result) ? $this : $result;
    }

    protected function assignFlightData($flightData = array()) {
        $this->flightData['flightNumber'] = $flightData[0] ?? '';
        $this->flightData['estimatedTimeOfDeparture'] = $flightData[1] ?? '';
        $this->flightData['estimatedTimeOfArrival'] = $flightData[2] ?? '';
        $this->flightData['departureAirport'] = $flightData[3] ?? '';
        $this->flightData['arrivalAirport'] = $flightData[4] ?? '';
        $this->flightData['delay'] = $flightData[5] ?? 0;

        return $this->flightData;
    }

    /**
     * @return array
     */
    public function getTotalCrew(): array
    {
        return $this->crew;
    }

    /**
     * @param FlightRepositoryInterface $repo
     * @param Crew $crew
     * @param Flight $flight
     * @return Flight
     * @throws NumberOfCabinCrewExceededException
     * @throws NumberOfPilotsExceededException
     */
    public function assignCrewToFlight(FlightRepositoryInterface $repo, Crew $crew, Flight $flight)
    {
        $this->validateFlightCrew($crew);
        $this->crew[] = $crew;

        $result = $repo->assignCrewToFlight($crew, $flight);
        return is_null($result) ? $this : $result;

    }

    public function removeCrewFromFlight(FlightRepositoryInterface $repo, Crew $crew, Flight $flight)
    {
        $this->crew[] = $crew;

        $result = $repo->removeCrewFromFlight($crew, $flight);
        return is_null($result) ? $this : $result;
    }

    protected function getNumberOfCrewOnFlight() {
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
        $crewOnFlight = $this->getNumberOfCrewOnFlight();

        if($crew->getPosition()==='pilot' && $crewOnFlight['numPilots'] === self::NUMBER_OF_PILOTS_ON_FLIGHT) {
            throw new NumberOfPilotsExceededException("No more pilots needed...");
        }

        if($crew->getPosition()==='cabincrew' && $crewOnFlight['numCabinCrews'] === self::NUMBER_OF_CABIN_CREW_ON_FLIGHT) {
            throw new NumberOfCabinCrewExceededException("No more cabin crew needed...");
        }

        return true;

    }

    public function isComplete()
    {
        $crewOnFlight = $this->getNumberOfCrewOnFlight();

        return ((int)$crewOnFlight['numPilots']===2 && (int)$crewOnFlight['numCabinCrews']===4);
    }



}
