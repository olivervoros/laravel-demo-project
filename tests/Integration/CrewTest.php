<?php


namespace Tests\Integration;

use App\Crew;
use App\Repositories\CrewRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrewTest extends TestCase
{
    use RefreshDatabase;

    private $repo;

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
        $this->repo = new CrewRepository();
    }

    /** @test */
    public function it_fetches_all_the_sixteen_cabin_crews()
    {
        $allCrews = $this->repo->getAll();
        $this->assertCount(16, $allCrews);
    }

    /** @test */
    public function it_fetches_all_the_six_pilots()
    {
        $allPilots = $this->repo->getAllPilots();
        $this->assertCount(6, $allPilots);
    }

    /** @test */
    public function it_fetches_all_the_ten_cabin_crews()
    {
        $allCabinCrews = $this->repo->getAllCabinCrews();
        $this->assertCount(10, $allCabinCrews);
    }

    /** @test */
    public function it_saves_a_new_crew_in_the_database_and_then_we_have_seventeen_crews()
    {
        new Crew($this->repo, 'Test Pilot', 'pilot');

        $result = $this->repo->getCrewByName('Test Pilot');
        $this->assertNotEmpty($result);

        $allCrews = $this->repo->getAll();
        $this->assertCount(17, $allCrews);
    }

}
