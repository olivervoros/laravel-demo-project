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
    public function it_fetches_all_the_sixteen_crews()
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
        $crew->addCrew($this->crewRepo, 'Test Pilot', 'pilot');

        $result = $this->crewRepo->getCrewByName('Test Pilot');
        $this->assertNotEmpty($result);

        $allCrews = $this->crewRepo->getAll();
        $this->assertCount(17, $allCrews);
    }

    /** @test */
    public function crew_can_be_modified()
    {
        $crew = new Crew();
        $crew = $crew->addCrew($this->crewRepo, 'Cabin Crew to Modify', 'cabincrew');
        $modifiedCrew = $crew->modifyCrew($this->crewRepo, $crew, 'Modified Cabin Crew', 'cabincrew');

        $this->assertEquals("Modified Cabin Crew", $modifiedCrew->name);
        $this->assertEquals("cabincrew", $modifiedCrew->position);
    }

    /** @test */
    public function crew_can_be_deleted()
    {
        $crew = new Crew();
        $crewToDelete1 = $crew->getCrewByNameAndPosition($this->crewRepo,'Samantha', 'cabincrew');
        $crewToDelete2 = $crew->getCrewByNameAndPosition($this->crewRepo,'Steve', 'pilot');

        $crew->deleteCrew($this->crewRepo, $crewToDelete1->id);
        $crew->deleteCrew($this->crewRepo, $crewToDelete2->id);

        $allCrews = $this->crewRepo->getAll();
        $this->assertCount(14, $allCrews);

    }

    /** @test
     * @throws \Exception
     */
    public function crew_can_be_assigned_to_a_flight()
    {
        $flight = new Flight();
        $savedFlight = $flight->saveFlight($this->flightRepo, ['Test', '11:00', '20:00', 'San Francisco', 'Los Angeles', 40]);

        $crew1 = new Crew();
        $crew1 = $crew1->addCrew($this->crewRepo, "Brian", "Pilot");
        $crew2 = new Crew();
        $crew2 = $crew2->addCrew($this->crewRepo,"James", "Pilot");

        $flight->assignCrewToFlight($this->flightRepo, $crew1, $savedFlight);
        $flight->assignCrewToFlight($this->flightRepo, $crew2, $savedFlight);
        $crewOnFlight = $savedFlight->crews()->get()->toArray();

        $this->assertCount(2, $crewOnFlight);
    }

    /** @test
     * @throws \Exception
     */
    public function crew_can_be_assigned_and_then_removed_from_a_flight()
    {
        $flight = new Flight();
        $savedFlight = $flight->saveFlight($this->flightRepo, ['Another Test', '19:00', '08:00', 'Singapore', 'Bangkok', 20]);

        $crew1 = new Crew();
        $crew1 = $crew1->addCrew($this->crewRepo, "Brian", "Pilot");
        $crew2 = new Crew();
        $crew2 = $crew2->addCrew($this->crewRepo,"James", "Pilot");
        $crew3 = new Crew();
        $crew3 = $crew3->addCrew($this->crewRepo,"Emily", "cabincrew");

        $flight->assignCrewToFlight($this->flightRepo, $crew1, $savedFlight);
        $flight->assignCrewToFlight($this->flightRepo, $crew2, $savedFlight);
        $flight->assignCrewToFlight($this->flightRepo, $crew3, $savedFlight);

        $this->assertCount(3, $savedFlight->crews()->get()->toArray());

        $flight->removeCrewFromFlight($this->flightRepo, $crew2, $savedFlight);
        $crewOnFlight = $savedFlight->crews()->get()->toArray();
        $this->assertCount(2, $crewOnFlight);
        $this->assertEqualsIgnoringCase('pilot', $crewOnFlight[0]['position']);
        $this->assertEquals('cabincrew', $crewOnFlight[1]['position']);

    }

}
