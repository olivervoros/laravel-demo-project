<?php


namespace App;

class Crew
{
    private $name;
    private $position;
    private $availablePositions = ['pilot', 'cabincrew'];

    /**
     * Crew constructor.
     * @param $name
     * @param $position
     * @throws \Exception
     */
    public function __construct(string $name, string $position)
    {
        if(!in_array(strtolower($position), $this->availablePositions)) {
            throw new \Exception("Invalid Crew Type...");
        }
        $this->name = $name;
        $this->position = strtolower($position);
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
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = strtolower($position);
    }




}
