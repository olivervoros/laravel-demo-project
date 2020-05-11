<?php


namespace App\FishingCompetition;


class Fisherman
{
    private $name;
    private $email;
    private $age;
    private $score;

    /**
     * Fisherman constructor.
     * @param $name
     * @param $email
     * @param $age
     * @param $score
     */
    public function __construct($name, $email, $age, $score = 0)
    {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score): void
    {
        $this->score = $score;
    }
}
