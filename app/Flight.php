<?php


namespace App;
use App\Repositories\FlightRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    private $flightData = [];
    private $crew = [];
    private $repo;

    const NUMBER_OF_PILOTS_ON_FLIGHT = 2;
    const NUMBER_OF_CABIN_CREW_ON_FLIGHT = 4;


    /**
     * Flight constructor.
     * @param FlightRepositoryInterface $repo
     * @param array $flightData
     */
    public function __construct(FlightRepositoryInterface $repo = null, $flightData = [])
    {
        $this->flightData['flightNumber'] = $flightData[0];
        $this->flightData['estimatedTimeOfDeparture'] = $flightData[1] ?? '';
        $this->flightData['estimatedTimeOfArrival'] = $flightData[2] ?? '';
        $this->flightData['departureAirport'] = $flightData[3] ?? '';
        $this->flightData['arrivalAirport'] = $flightData[4] ?? '';
        $this->flightData['delay'] = $flightData[5] ?? 0;
        $this->repo = $repo ?? null;

        if(!empty($this->repo) AND !empty($this->flightData)) {
            return $this->repo->saveFlight($this->flightData);
        }
    }

    /**
     * @return array
     */
    public function getFlightData(): array
    {
        return $this->flightData;
    }

    /**
     * @param array $flightData
     */
    public function setFlightData(array $flightData): void
    {
        $this->flightData = $flightData;
    }

    public function crews()
    {
        return $this->belongsToMany('App\Crew');
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

        //return $this->repo->addCrew($crew);
    }

    protected function getCrewOnFlight() {
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
