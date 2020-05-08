<?php


namespace Tests\Unit;

use App\Crew;
use PHPUnit\Framework\TestCase;

class CrewTest extends TestCase
{

    protected $crew;

    public function setUp():void {
        $this->crew = new Crew("Oliver", "Pilot");
    }

    /** @test */
    public function a_crew_has_a_name()
    {
        $this->assertEquals('Oliver', $this->crew->getName());
    }

    /** @test */
    public function a_crew_has_a_position()
    {
        $this->assertEquals('Pilot', $this->crew->getPosition());
    }

    /** @test */
    public function invalid_crew_type_throws_an_exception()
    {
        $this->expectException("\Exception");
        new Crew("John", "Gardener");

    }

}
