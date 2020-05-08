<?php

namespace App\FishingCompetition;

class FishingCompetition {

    private $title;
    private $registeredFishermen = [];
    private $db;
    private $numberOfFishermenParticipants = 0;

    const MAXIMUM_FISHERMEN_PARTICIPANTS = 10;

    public function __construct(Db $db, string $title = "Fisherman Competition", int $numberOfFishermenParticipants = 10) {
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

    

    private function validateCompetition(int $numberOfFishermenParticipants) {
        if($numberOfFishermenParticipants < 1) {
            throw new \Exception('Cannot have negative or zero fishermen registered for the competition.');
        }

        if(self::MAXIMUM_FISHERMEN_PARTICIPANTS < $numberOfFishermenParticipants) {
            throw new \Exception('Cannot have more than '.self::MAXIMUM_FISHERMEN_PARTICIPANTS.' fishermen registered');
        }
    }

    public function addFisherman(Fisherman $fisherman) {

        // 1. Check if there is still place to register
        if($this->isCompetitionFull()) {
            throw new \Exception('The competition is already full.');
        }

        $this->registeredFishermen[] = $fisherman;

        $this->db->saveRecords($fisherman);

    }

    public function runCompetition() {
        foreach($this->registeredFishermen as $key => $fisherman) {
            $randomScore = random_int(1, 100);
            $this->registeredFishermen[$key]->score = $randomScore;
        }

        return ksort($this->registeredFishermen);

    }

    public function isCompetitionFull():bool {
        $numRegisteredFishermen = $this->getNumberOfRegisteredFishermen();
        return (bool) ($this->numberOfFishermenParticipants <= $numRegisteredFishermen);
    }

    public function getNumberOfRegisteredFishermen():int {

        return count($this->registeredFishermen);
    }

}
