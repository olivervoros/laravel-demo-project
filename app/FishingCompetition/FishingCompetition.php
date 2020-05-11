<?php


namespace App\FishingCompetition;

use App\FishingCompetition\Exceptions\{CompetitionIsFinishedException,
    CompetitionIsFullException,
    MaximumFishermenNumberExceededException,
    ZeroOrNegativeFishermanLimitSetException
};


class FishingCompetition
{

    private $title;
    private $registeredFishermen = [];
    private $db;
    private $numberOfFishermenParticipants = 0;
    private $result = [];
    private $competitionIsFinished = false;
    const MAXIMUM_FISHERMEN_PARTICIPANTS = 10;


    public function __construct(Db $db, string $title = "Fisherman Competition", int $numberOfFishermenParticipants = 10)
    {
        $this->db = $db;
        $this->title = $title;
        $this->numberOfFishermenParticipants = $numberOfFishermenParticipants;
        $this->validateCompetition($numberOfFishermenParticipants);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Db
     */
    public function getDb(): Db
    {
        return $this->db;
    }

    /**
     * @param Db $db
     */
    public function setDb(Db $db): void
    {
        $this->db = $db;
    }

    public function addFisherman(Fisherman $fisherman)
    {
        if ($this->isCompetitionFull()) {
            throw new CompetitionIsFullException('The competition is already full.');
        }
        if ($this->isCompetitionFinished()) {
            throw new CompetitionIsFinishedException('The competition is finished.');
        }
        $this->registeredFishermen[] = $fisherman;
        $this->db->saveRecords($fisherman);
    }

    public function runCompetition()
    {
        if ($this->isCompetitionFinished()) {
            throw new CompetitionIsFinishedException('The competition is finished.');
        }
        foreach ($this->registeredFishermen as $key => $fisherman) {
            $randomScore = random_int(1, 100);
            $this->registeredFishermen[$key]->setScore($randomScore);
        }
        $this->result = $this->registeredFishermen;
        $this->competitionIsFinished = true;
        return $this->result;
    }

    public function isCompetitionFull(): bool
    {
        $numRegisteredFishermen = $this->getNumberOfRegisteredFishermen();
        return (bool)($this->numberOfFishermenParticipants <= $numRegisteredFishermen);
    }

    public function getNumberOfRegisteredFishermen(): int
    {
        return count($this->registeredFishermen);
    }

    private function validateCompetition(int $numberOfFishermenParticipants)
    {
        if ($numberOfFishermenParticipants < 1) {
            throw new ZeroOrNegativeFishermanLimitSetException('Cannot have negative or zero fishermen registered for the competition.');
        }
        if (self::MAXIMUM_FISHERMEN_PARTICIPANTS < $numberOfFishermenParticipants) {
            throw new MaximumFishermenNumberExceededException('Cannot have more than ' . self::MAXIMUM_FISHERMEN_PARTICIPANTS . ' fishermen registered');
        }
    }

    private function isCompetitionFinished()
    {
        return $this->competitionIsFinished;
    }
}
