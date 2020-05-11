<?php


namespace Tests\Unit;

use App\Crew;
use PHPUnit\Framework\TestCase;

class CrewTest extends TestCase
{

    private $crew;
    private $dummyRepo;

    public function setUp():void {
        $repoProphecy = $this->prophesize('\App\Repositories\CrewRepository');
        $this->dummyRepo = $repoProphecy->reveal();
        $this->crew = new Crew();
    }

    /** @test */
    public function a_crew_has_a_name()
    {
        $this->crew->saveCrew($this->dummyRepo,"Oliver", "pilot");
        $this->assertEquals('Oliver', $this->crew->getName());
    }

    /** @test */
    public function a_crew_has_a_position()
    {
        $this->crew->saveCrew($this->dummyRepo,"Oliver", "pilot");
        $this->assertEquals('pilot', $this->crew->getPosition());
    }

    /** @test */
    public function invalid_crew_type_throws_an_exception()
    {
        $this->expectException("App\Exceptions\InvalidCrewTypeException");
        $crew = new Crew();
        $crew->saveCrew($this->dummyRepo,"John", "Gardener");

    }

}
