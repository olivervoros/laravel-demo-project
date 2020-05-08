<?php


namespace Tests\Unit;

use App\Flight;
use PHPUnit\Framework\TestCase;


class FlightTest extends TestCase
{
    protected $flight;

    public function setUp():void {
        $this->flight = new Flight('BA870', '10:30',
            '12:00', 'Budapest', 'London');
    }

    /** @test */
    public function a_flight_has_a_number()
    {
        $this->assertEquals('BA870', $this->flight->getFlightNumber());
    }

    /** @test */
    public function a_flight_has_an_estimated_departure_time()
    {
        $this->assertEquals('10:30', $this->flight->getEstimatedTimeOfDeparture());
    }

    /** @test */
    public function a_flight_has_an_estimated_arrival_time()
    {
        $this->assertEquals('12:00', $this->flight->getEstimatedTimeOfArrival());
    }

    /** @test */
    public function a_flight_has_a_departure_city()
    {
        $this->assertEquals('Budapest', $this->flight->getDepartureAirport());
    }

    /** @test */
    public function a_flight_has_an_arrival_city()
    {
        $this->assertEquals('London', $this->flight->getArrivalAirport());
    }

}
