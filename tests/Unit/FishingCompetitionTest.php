<?php


namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\FishingCompetition\FishingCompetition;
use App\FishingCompetition\Db;
use App\FishingCompetition\Fisherman;
use Prophecy\Argument;

class FishingCompetitionTest extends TestCase {

    /** @test */
    public function fishing_competition_has_a_title() {
        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();
        $competition = new FishingCompetition($dummyDb, "Test Competition", 8);

        $this->assertEquals("Test Competition", $competition->getTitle());
    }

    /** @test */
    public function negative_fishing_competition_limit_returns_an_exception() {

        $this->expectException("\Exception");

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal(); // This is a dummy

       new FishingCompetition($dummyDb, "Test Competition", -3);

    }

    /** @test */
    public function zero_fishing_competition_limit_returns_an_exception() {

        $this->expectException("\Exception");

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        new FishingCompetition($dummyDb, "Test Competition", 0);

    }

    /** @test */
    public function higher_than_maximum_fishing_competition_limit_returns_an_exception() {

        $this->expectException("\Exception");

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        new FishingCompetition($dummyDb, "Test Competition", 28);

    }

    /** @test */
    public function gets_the_number_of_registered_fisherman_for_the_competition() {

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();
        $competition = new FishingCompetition($dummyDb, "Test Competition", 8);

        $fisherman1 = new Fisherman("Oliver", "oliver@test.com", 39);
        $fisherman2 = new Fisherman("John", "john@test.com", 23);
        $fisherman3 = new Fisherman("Sam", "sam@test.com", 55);

        $competition->addFisherman($fisherman1);
        $competition->addFisherman($fisherman2);
        $competition->addFisherman($fisherman3);

        $this->assertEquals(3, $competition->getNumberOfRegisteredFishermen());

    }

    /** @test */
    public function the_save_method_is_called_twice_when_two_fishermen_register() {

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        $competition = new FishingCompetition($dummyDb, "Test Competition", 8);
        $fisherman1 = new Fisherman('Oliver', 'oliver@test.com', 22);
        $fisherman2 = new Fisherman('Bernarda', 'bernarda@test', 43);

        $dbProphecy->saveRecords(Argument::type(Fisherman::class))->shouldBeCalledTimes(2); // MOCK

        $competition->addFisherman($fisherman1);
        $competition->addFisherman($fisherman2);

    }

    /** @test */
   public function the_number_of_times_the_save_mehjod_is_called_when_two_fishermen_register_with_spy() {

       $dbProphecy = $this->prophesize(Db::class);
       $dummyDb = $dbProphecy->reveal();

       $competition = new FishingCompetition($dummyDb, "Test Competition", 10);
       $fisherman1 = new Fisherman('Oliver', 'oliver@test.com', 22);
       $fisherman2 = new Fisherman('Bernarda', 'bernarda@test', 43);
       $fisherman3 = new Fisherman('James', 'james@test', 30);

       $competition->addFisherman($fisherman1);
       $competition->addFisherman($fisherman2);
       $competition->addFisherman($fisherman3);

       $dbProphecy->saveRecords(Argument::type(Fisherman::class))->shouldHaveBeenCalled(); // SPY
   }

    /**
     * @dataProvider fishermanDataProvider
     * /** @test
     * @param Fisherman $fisherman
     * @throws \Exception
     */
    public function number_of_times_save_is_called_when_four_fishermen_register(Fisherman $fisherman) {


        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        $competition = new FishingCompetition($dummyDb, "Test Competition", 9);

        // This is a FAKE, a simplified or different modification of the original function
        $dbProphecy->saveRecords($fisherman)->will(function ($age) {
            if ($age < 18) {
                return false;
            }
            return true;
        });

        $competition->addFisherman($fisherman);

        $dbProphecy->saveRecords($fisherman)->shouldHaveBeenCalled(); // SPY

    }

    public function fishermanDataProvider() {
        return  [
            [new Fisherman('Szabo Janos', 'szj.@gamil.com', 22)],
            [new Fisherman('Kovacs Alajos', 'ka.@gamil.com', 29)],
            [new Fisherman('Nemeth Timea', 'nt@gmail.com', 45)],
            [new Fisherman('Dajka Laszlo', 'dl@gmail.com', 55)]
        ];
    }

}
