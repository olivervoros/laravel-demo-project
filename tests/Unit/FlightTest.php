<?php


namespace Tests\Unit;

use App\Crew;
use App\Flight;
use PHPUnit\Framework\TestCase;


class FlightTest extends TestCase
{
    protected $flight;

    public function setUp():void {

        parent::setUp();

        $repoProphecy = $this->prophesize('\App\Repositories\FlightRepository');
        $dummyFlightRepo = $repoProphecy->reveal();

        $flightData = ['BA870', '10:30', '12:00', 'Budapest', 'London'];
        $this->flight = new Flight($dummyFlightRepo, $flightData);
    }

    /** @test */
    public function a_flight_has_a_number()
    {
        $this->assertEquals('BA870', $this->flight->getFlightData()['flightNumber']);
    }

    /** @test */
    public function a_flight_has_an_estimated_departure_time()
    {
        $this->assertEquals('10:30', $this->flight->getFlightData()['estimatedTimeOfDeparture']);
    }

    /** @test */
    public function a_flight_has_an_estimated_arrival_time()
    {
        $this->assertEquals('12:00', $this->flight->getFlightData()['estimatedTimeOfArrival']);
    }

    /** @test */
    public function a_flight_has_a_departure_city()
    {
        $this->assertEquals('Budapest', $this->flight->getFlightData()['departureAirport']);
    }

    /** @test */
    public function a_flight_has_an_arrival_city()
    {
        $this->assertEquals('London', $this->flight->getFlightData()['arrivalAirport']);
    }

    /** @test */
    public function crew_can_be_added_to_a_flight()
    {
        $repoProphecy = $this->prophesize('\App\Repositories\CrewRepository');
        $dummyCrewRepo = $repoProphecy->reveal();
        $crew1 = new Crew($dummyCrewRepo, "Brian", "Pilot");
        $crew2 = new Crew($dummyCrewRepo,"James", "Pilot");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);

        $this->assertCount(2, $this->flight->getTotalCrew());
    }

    /** @test */
    public function adding_three_pilots_to_a_flight_throws_an_exception()
    {
        $this->expectException("\Exception");

        $repoProphecy = $this->prophesize('\App\Repositories\CrewRepository');
        $dummyCrewRepo = $repoProphecy->reveal();
        $crew1 = new Crew($dummyCrewRepo,"Brian", "Pilot");
        $crew2 = new Crew($dummyCrewRepo,"James", "Pilot");
        $crew3 = new Crew($dummyCrewRepo,"Thomas", "Pilot");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);
        $this->flight->addCrew($crew3);
    }

    /** @test */
    public function adding_five_cabin_crew_to_a_flight_throws_an_exception()
    {
        $this->expectException("\Exception");

        $repoProphecy = $this->prophesize('\App\Repositories\CrewRepository');
        $dummyCrewRepo = $repoProphecy->reveal();
        $crew1 = new Crew($dummyCrewRepo,"Suzy", "cabincrew");
        $crew2 = new Crew($dummyCrewRepo,"Anita", "cabincrew");
        $crew3 = new Crew($dummyCrewRepo,"Brigitte", "cabincrew");
        $crew4 = new Crew($dummyCrewRepo,"Jennifer", "cabincrew");
        $crew5 = new Crew($dummyCrewRepo,"Jessica", "cabincrew");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);
        $this->flight->addCrew($crew3);
        $this->flight->addCrew($crew4);
        $this->flight->addCrew($crew5);
    }

    /** @test */
    public function the_flight_is_complete_with_two_pilots_and_four_cabin_crew()
    {
        $repoProphecy = $this->prophesize('\App\Repositories\CrewRepository');
        $dummyCrewRepo = $repoProphecy->reveal();
        $crew1 = new Crew($dummyCrewRepo,"John", "pilot");
        $crew2 = new Crew($dummyCrewRepo,"Peter", "pilot");
        $crew3 = new Crew($dummyCrewRepo,"Anita", "cabincrew");
        $crew4 = new Crew($dummyCrewRepo,"Brigitte", "cabincrew");
        $crew5 = new Crew($dummyCrewRepo,"Jennifer", "cabincrew");
        $crew6 = new Crew($dummyCrewRepo,"Jessica", "cabincrew");

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
        $repoProphecy = $this->prophesize('\App\Repositories\CrewRepository');
        $dummyCrewRepo = $repoProphecy->reveal();
        $crew1 = new Crew($dummyCrewRepo,"John", "pilot");
        $crew2 = new Crew($dummyCrewRepo,"Brigitte", "cabincrew");
        $crew3 = new Crew($dummyCrewRepo,"Jennifer", "cabincrew");
        $crew4 = new Crew($dummyCrewRepo,"Jessica", "cabincrew");

        $this->flight->addCrew($crew1);
        $this->flight->addCrew($crew2);
        $this->flight->addCrew($crew3);
        $this->flight->addCrew($crew4);

        $this->assertFalse($this->flight->isComplete());
    }

}
