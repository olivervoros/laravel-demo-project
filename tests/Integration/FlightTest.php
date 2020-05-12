<?php


namespace Tests\Integration;

use App\Flight;
use App\Repositories\FlightRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    private $repo;
    private $flight;

    public function setUp():void
    {
        parent::setUp();

        $this->seed();
        $this->repo = new FlightRepository();
        $this->flight = new Flight();
    }

    /** @test */
    public function it_fetches_delayed_flights()
    {
        $delayedFlights = $this->repo->getDelayedFlights();
        $this->assertCount(2, $delayedFlights);
    }

    /** @test */
    public function it_fetches_on_time_flights()
    {
        $onTimedFlights = $this->repo->getOnTimeFlights();
        $this->assertCount(3, $onTimedFlights);
    }

    /** @test */
    public function it_fetches_all_the_five_flights()
    {
        $allFlights = $this->repo->getAll();
        $this->assertCount(5, $allFlights);
    }

    /** @test */
    public function can_save_a_new_flight_in_the_database_and_after_we_will_have_a_total_of_six_flights() {

        $this->flight->saveFlight($this->repo, ['Test', '11:00', '13:00', 'Barcelona', 'Frankfurt', 0]);
        $result = $this->repo->getFlightByFlightNumber('Test');
        $this->assertNotEmpty($result);

        $allFlights = $this->repo->getAll();
        $this->assertCount(6, $allFlights);

    }

    /** @test */
    public function can_save_a_flight_and_then_modify_it()
    {
        $flight = new Flight();
        $savedFlight = $flight->saveFlight($this->repo, ['Test', '11:00', '13:00', 'Barcelona', 'Frankfurt', 0]);
        $modifiedFlight = $savedFlight->modifyFlight($this->repo, $savedFlight->id, ['Modified', '11:00', '13:00', 'Barcelona', 'Frankfurt', 0]);

        $this->assertEquals("Modified", $modifiedFlight->flightNumber);
        $this->assertEquals("Frankfurt", $modifiedFlight->arrivalAirport);
        $this->assertEquals(0, $modifiedFlight->delay);
    }

    /** @test */
    public function can_delete_a_flight()
    {
        $flight = new Flight();
        $flightToDelete = $flight->getFlightByFlightNumber($this->repo,'WZZ235');
        $this->flight->deleteFlight($this->repo, $flightToDelete->id);

        $allFlights = $this->repo->getAll();
        $this->assertCount(4, $allFlights);
    }



}
