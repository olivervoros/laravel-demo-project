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
    public function it_fetches_delayed_flights_using_repo()
    {
        $delayedFlights = $this->repo->getDelayedFlights();
        $this->assertCount(2, $delayedFlights);
    }

    /** @test */
    public function it_fetches_delayed_flights_using_eloquent()
    {
        $delayedFlights = Flight::Delayed();
        $this->assertCount(2, $delayedFlights);
    }

    /** @test */
    public function it_fetches_on_time_flights_using_repo()
    {
        $onTimedFlights = $this->repo->getOnTimeFlights();
        $this->assertCount(3, $onTimedFlights);
    }

    /** @test */
    public function it_fetches_on_time_with_eloquent()
    {
        $onTimedFlights = Flight::OnTime();
        $this->assertCount(3, $onTimedFlights);
    }

    /** @test */
    public function it_fetches_all_the_five_flights()
    {
        $allFlights = $this->repo->getAll();
        $this->assertCount(5, $allFlights);
    }

    /** @test */
    public function it_fetches_all_the_five_flights_using_eloquent()
    {
        $allFlights = Flight::all();
        $this->assertCount(5, $allFlights);
    }

    /** @test */
    public function can_save_a_new_flight_in_the_database_and_after_we_will_have_a_total_of_six_flights() {

        $this->flight->setFlightData($this->repo, ['Test', '11:00', '13:00', 'Barcelona', 'Frankfurt', 0]);
        $result = $this->repo->getFlightByFlightNumber('Test');
        $this->assertNotEmpty($result);

        $allFlights = $this->repo->getAll();
        $this->assertCount(6, $allFlights);

    }

    /** @test */
    public function can_save_a_flight_and_then_modify_it_with_eloquent()
    {
        $flightNumber = $this->flight->setFlightData($this->repo, ['Test', '11:00', '13:00', 'Barcelona', 'Frankfurt', 0]);
        $savedFlight = Flight::find($flightNumber)->first();
        $savedFlight->flightNumber = "Modified";
        $savedFlight->save();
        $modifiedFlight = Flight::find($flightNumber)->first();
        $this->assertEquals("Modified", $modifiedFlight->flightNumber);
        $this->assertEquals("Frankfurt", $modifiedFlight->arrivalAirport);
        $this->assertEquals(0, $modifiedFlight->delay);
    }

    /** @test */
    public function can_delete_a_flight_with_eloquent()
    {
        $firstFlight = Flight::orderBy('id', 'ASC')->first();
        $firstFlight->delete();

        $deletedFlight = Flight::find($firstFlight->id);
        $this->assertNull($deletedFlight);

        $allFlights = Flight::all();
        $this->assertCount(4, $allFlights);
    }



}
