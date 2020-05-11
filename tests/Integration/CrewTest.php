<?php


namespace Tests\Integration;

use App\Crew;
use App\Flight;
use App\Repositories\CrewRepository;
use App\Repositories\FlightRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrewTest extends TestCase
{
    use RefreshDatabase;

    private $crewRepo;
    private $flightRepo;

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
        $this->crewRepo = new CrewRepository();
        $this->flightRepo = new FlightRepository();
    }

    /** @test */
    public function it_fetches_all_the_sixteen_cabin_crews()
    {
        $allCrews = $this->crewRepo->getAll();
        $this->assertCount(16, $allCrews);
    }

    /** @test */
    public function it_fetches_all_the_six_pilots()
    {
        $allPilots = $this->crewRepo->getAllPilots();
        $this->assertCount(6, $allPilots);
    }

    /** @test */
    public function it_fetches_all_the_ten_cabin_crews()
    {
        $allCabinCrews = $this->crewRepo->getAllCabinCrews();
        $this->assertCount(10, $allCabinCrews);
    }

    /** @test */
    public function it_saves_a_new_crew_in_the_database_and_then_we_have_seventeen_crews()
    {
        $crew = new Crew();
        $crew->saveCrew($this->crewRepo, 'Test Pilot', 'pilot');

        $result = $this->crewRepo->getCrewByName('Test Pilot');
        $this->assertNotEmpty($result);

        $allCrews = $this->crewRepo->getAll();
        $this->assertCount(17, $allCrews);
    }

    /** @test
     * @throws \Exception
     */
    public function crew_can_be_assigned_to_a_flight()
    {

        $flight = new Flight();
        $flightNumber = $flight->setFlightData($this->flightRepo, ['Test', '11:00', '20:00', 'San Francisco', 'Los Angeles', 40]);
        $savedFlight = Flight::find($flightNumber)->first();

        $crew1 = new Crew();
        $crew1Id = $crew1->saveCrew($this->crewRepo, "Brian", "Pilot");
        $crew2 = new Crew();
        $crew2Id = $crew2->saveCrew($this->crewRepo,"James", "Pilot");

        $savedFlight->crews()->attach([$crew1Id, $crew2Id]);
        $crewOnFlight = $savedFlight->crews()->get()->toArray();

        $this->assertCount(2, $crewOnFlight);
    }

    /** @test
     * @throws \Exception
     */
    public function crew_can_be_assigned_and_then_removed_from_a_flight()
    {
        $flight = new Flight();
        $flightNumber = $flight->setFlightData($this->flightRepo, ['Another Test', '19:00', '08:00', 'Singapore', 'Bangkok', 20]);
        $savedFlight = Flight::find($flightNumber)->first();

        $crew1 = new Crew();
        $crew1Id = $crew1->saveCrew($this->crewRepo, "Brian", "Pilot");
        $crew2 = new Crew();
        $crew2Id = $crew2->saveCrew($this->crewRepo,"James", "Pilot");
        $crew3 = new Crew();
        $crew3Id = $crew3->saveCrew($this->crewRepo,"Samantha", "cabincrew");

        $savedFlight->crews()->attach([$crew1Id, $crew2Id, $crew3Id]);
        $this->assertCount(3, $savedFlight->crews()->get()->toArray());

        $savedFlight->crews()->detach([$crew2Id]);
        $crewOnFlight = $savedFlight->crews()->get()->toArray();

        $this->assertCount(2, $crewOnFlight);
        $this->assertEqualsIgnoringCase('pilot', $crewOnFlight[0]['position']);
        $this->assertEquals('cabincrew', $crewOnFlight[1]['position']);
    }

}
