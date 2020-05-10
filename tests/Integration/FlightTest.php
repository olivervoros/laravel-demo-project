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

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
        $this->repo = new FlightRepository();
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

        $flightData = ['Test', '11:00', '13:00', 'Barcelona', 'Frankfurt', 0];
        new Flight($this->repo, $flightData);
        $result = $this->repo->getFlightByFlightNumber('Test');
        $this->assertNotEmpty($result);

        $allFlights = $this->repo->getAll();
        $this->assertCount(6, $allFlights);

    }



}
