<?php


namespace Tests\Unit;

use App\Crew;
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

    /** @test */
    public function crew_can_be_added_to_a_flight()
    {
        $crew1 = new Crew("Brian", "Pilot");
        $crew2 = new Crew("James", "Pilot");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);

        $this->assertCount(2, $this->flight->getTotalCrew());
    }

    /** @test */
    public function adding_three_pilots_to_a_flight_throws_an_exception()
    {
        $this->expectException("\Exception");

        $crew1 = new Crew("Brian", "Pilot");
        $crew2 = new Crew("James", "Pilot");
        $crew3 = new Crew("Thomas", "Pilot");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);
        $this->flight->addCrew($crew3);
    }

    /** @test */
    public function adding_five_cabin_crew_to_a_flight_throws_an_exception()
    {
        $this->expectException("\Exception");

        $crew1 = new Crew("Suzy", "cabincrew");
        $crew2 = new Crew("Anita", "cabincrew");
        $crew3 = new Crew("Brigitte", "cabincrew");
        $crew4 = new Crew("Jennifer", "cabincrew");
        $crew5 = new Crew("Jessica", "cabincrew");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);
        $this->flight->addCrew($crew3);
        $this->flight->addCrew($crew4);
        $this->flight->addCrew($crew5);
    }

    /** @test */
    public function the_flight_is_complete_with_two_pilots_and_four_cabin_crew()
    {
        $crew1 = new Crew("John", "pilot");
        $crew2 = new Crew("Peter", "pilot");
        $crew3 = new Crew("Anita", "cabincrew");
        $crew4 = new Crew("Brigitte", "cabincrew");
        $crew5 = new Crew("Jennifer", "cabincrew");
        $crew6 = new Crew("Jessica", "cabincrew");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);
        $this->flight->addCrew($crew3);
        $this->flight->addCrew($crew4);
        $this->flight->addCrew($crew5);
        $this->flight->addCrew($crew6);

        $this->assertTrue($this->flight->isComplete());
    }

    /** @test */
    public function the_flight_is_incomplete_with_one_pilot_and_three_cabin_crew()
    {
        $crew1 = new Crew("John", "pilot");
        $crew2 = new Crew("Brigitte", "cabincrew");
        $crew3 = new Crew("Jennifer", "cabincrew");
        $crew4 = new Crew("Jessica", "cabincrew");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);
        $this->flight->addCrew($crew3);
        $this->flight->addCrew($crew4);

        $this->assertFalse($this->flight->isComplete());
    }

}
