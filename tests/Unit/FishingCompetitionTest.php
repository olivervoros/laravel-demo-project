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
    public function negative_fishermen_registration_limit_returns_an_exception() {

        $this->expectException("App\FishingCompetition\Exceptions\ZeroOrNegativeFishermanLimitSetException");

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal(); // This is a dummy

        new FishingCompetition($dummyDb, "Test Competition", -3);

    }

    /** @test */
    public function zero_fishermen_registration_limit_returns_an_exception() {

        $this->expectException("App\FishingCompetition\Exceptions\ZeroOrNegativeFishermanLimitSetException");

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        new FishingCompetition($dummyDb, "Test Competition", 0);

    }

    /** @test */
    public function higher_than_maximum_fishermen_registration_limit_returns_an_exception() {

        $this->expectException("App\FishingCompetition\Exceptions\MaximumFishermenNumberExceededException");

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
    public function the_save_method_is_called_when_a_new_fisherman_registers() {

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        $competition = new FishingCompetition($dummyDb, "Test Competition", 10);
        $fisherman1 = new Fisherman('Oliver', 'oliver@test.com', 22);
        $fisherman2 = new Fisherman('Susan', 'suzy@test', 43);
        $fisherman3 = new Fisherman('James', 'james@test', 30);

        $competition->addFisherman($fisherman1);
        $competition->addFisherman($fisherman2);
        $competition->addFisherman($fisherman3);

        $dbProphecy->saveRecords(Argument::type(Fisherman::class))->shouldHaveBeenCalled(); // SPY
    }

    /** @test */
    public function after_running_the_competition_we_have_a_valid_array_result()
    {
        $competition = $this->getCompetition();
        $result = $competition->runCompetition();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertObjectHasAttribute('name', $result[0]);
        $this->assertObjectHasAttribute('email', $result[0]);
        $this->assertObjectHasAttribute('score', $result[0]);
    }

    /** @test */
    public function after_running_the_competition_all_fishermen_has_the_score_between_one_and_hundred()
    {
        $competition = $this->getCompetition();
        $result = $competition->runCompetition();
        foreach($result as $res) {
            $this->assertGreaterThan(0, $res->getScore());
            $this->assertLessThan(101, $res->getScore());
        }
    }

    /** @test */
    public function cannot_add_fisherman_to_finished_competition() {

        $this->expectException("App\FishingCompetition\Exceptions\CompetitionIsFinishedException");

        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        $competition = new FishingCompetition($dummyDb, "Test Competition", 10);
        $fisherman1 = new Fisherman('Oliver', 'oliver@test.com', 22);
        $fisherman2 = new Fisherman('Susan', 'suzy@test', 43);
        $fisherman3 = new Fisherman('James', 'james@test', 30);

        $competition->addFisherman($fisherman1);
        $competition->addFisherman($fisherman2);
        $competition->addFisherman($fisherman3);

        $competition->runCompetition();

        $fisherman4 = new Fisherman('Steve', 'steve@test.com', 44);
        $competition->addFisherman($fisherman4);

    }

    /** @test */
    public function cannot_run_competition_twice()
    {
        $this->expectException("App\FishingCompetition\Exceptions\CompetitionIsFinishedException");

        $competiton = $this->getCompetition();
        $competiton->runCompetition();
        $competiton->runCompetition();
    }

    /**
     * @dataProvider fishermanDataProvider
     * /** @test
     * @param Fisherman $fisherman
     * @throws \Exception
     */
    public function save_method_is_called_when_a_new_fisherman_registers_using_data_provider(Fisherman $fisherman) {

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

        $dbProphecy->saveRecords(Argument::type(Fisherman::class))->shouldBeCalledTimes(1); // MOCK
        $competition->addFisherman($fisherman);
    }

    public function fishermanDataProvider() {
        return  [
            [new Fisherman('John Smith', 'js.@test.com', 22)],
            [new Fisherman('Kevin Denton', 'kd.@test.com', 29)],
            [new Fisherman('Michael Harris', 'mh@testl.com', 45)],
            [new Fisherman('Dave Connor', 'dc@gtest.com', 55)]
        ];
    }

    private function getCompetition() {
        $dbProphecy = $this->prophesize(Db::class);
        $dummyDb = $dbProphecy->reveal();

        $competition = new FishingCompetition($dummyDb, "Test Competition", 10);
        $fisherman1 = new Fisherman('Oliver', 'oliver@test.com', 22);
        $fisherman2 = new Fisherman('Susan', 'suzy@test', 43);
        $fisherman3 = new Fisherman('James', 'james@test', 30);

        $competition->addFisherman($fisherman1);
        $competition->addFisherman($fisherman2);
        $competition->addFisherman($fisherman3);

        return $competition;
    }

}
