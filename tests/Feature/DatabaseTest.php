<?php


namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Repositories\CrewRepository;
use App\Repositories\FlightRepository;
use App\Crew;

class DatabaseTest extends TestCase
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
    public function crew_database_cabincrew_named_susan_exists()
    {
        $this->assertDatabaseHas('crews', [
            'name' => 'Susan', 'position' => 'cabincrew'
        ]);
    }

    /** @test */
    public function crew_database_pilot_named_steve_exists()
    {
        $this->assertDatabaseHas('crews', [
            'name' => 'Steve', 'position' => 'pilot'
        ]);
    }

    /** @test */
    public function crew_database_does_not_have_a_pilot_named_george() {

        $this->assertDatabaseMissing('crews', [
            'name' => 'George', 'position' => 'pilot'
        ]);
    }

    /** @test */
    public function we_originally_had_a_pilot_named_steve_but_we_deleted_the_record() {

        $pilotToDelete = $this->crewRepo->getCrewByNameAndPosition("Steve", "pilot");
        $this->crewRepo->deleteCrew($pilotToDelete->id);

        $this->assertDeleted('crews', [
            'name' => 'Steve', 'position' => 'pilot'
        ]);
    }

    /** @test */
    public function we_originally_had_a_pilot_named_steve_but_we_deleted_the_record_using_the_crew_model() {

        $crew = new Crew();
        $pilotToDelete = (array) $crew->getCrewByNameAndPosition($this->crewRepo, "Steve", 'pilot');
        $crew->deleteCrew($this->crewRepo, $pilotToDelete['id']);

        $this->assertDeleted('crews', [
            'name' => 'Steve', 'position' => 'pilot'
        ]);
    }

    /** @test */
    public function we_have_a_flight_from_budapest_to_london() {

        $this->assertDatabaseHas('flights', [
            'departureAirport' => 'Budapest', 'arrivalAirport' => 'London'
        ]);
    }

    /** @test */
    public function we_have_a_flight_with_the_flight_number_ma610() {

        $this->assertDatabaseHas('flights', [
            'flightNumber' => 'MA610'
        ]);
    }

    /** @test */
    public function we_do_not_have_a_flight_with_two_hours_delay() {

        $this->assertDatabaseMissing('flights', [
            'delay' => '120'
        ]);
    }

    /** @test */
    public function if_we_add_a_new_crew_member_it_can_be_found_in_the_database() {

        $newCrew = ['name' => "Lucy", 'position' => 'cabincrew'];
        $this->crewRepo->addCrew($newCrew);

        $this->assertDatabaseHas('crews', $newCrew);
    }

    /** @test */
    public function if_we_add_a_new_flight_it_can_be_found_in_the_database() {

        $newFlight =    ['flightNumber' => "XXX900",
                        'estimatedTimeOfDeparture' => "09:30",
                        'estimatedTimeOfArrival' => '11:30',
                        'departureAirport' => "London",
                        'arrivalAirport' => 'Amsterdam',
                        'delay' => 0];

        $this->flightRepo->saveFlight($newFlight);

        $this->assertDatabaseHas('flights', $newFlight);
    }

    /** @test */
    public function if_we_modify_a_flight_the_record_gets_updated_in_the_database() {

        $flightToModify = (array) $this->flightRepo->getFlightByFlightNumber("LH110");

        $this->assertDatabaseHas('flights', $flightToModify);

        $this->flightRepo->modifyFlightData($flightToModify['id'],
            ['flightNumber' => 'LH110', 'estimatedTimeOfDeparture' => '21:00', 'estimatedTimeOfArrival' => '23:50',
                'departureAirport' => 'Frankfurt', 'arrivalAirport' => 'Istanbul', 'delay' => 120]);

        $this->assertDatabaseHas('flights', ['flightNumber' => 'LH110', 'delay' => 120]);
    }


}
