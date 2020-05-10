<?php


namespace App;

use App\Repositories\CrewRepository;

class Crew
{
    private $name;
    private $position;
    private $availablePositions = ['pilot', 'cabincrew'];
    private $repo;

    /**
     * Crew constructor.
     * @param CrewRepository $repo
     * @param string $name
     * @param string $position
     * @throws \Exception
     */
    public function __construct(CrewRepository $repo = null, string $name = '', string $position= '')
    {
        if(!in_array(strtolower($position), $this->availablePositions)) {
            throw new \Exception("Invalid Crew Type...");
        }
        $this->name = $name;
        $this->position = strtolower($position);
        $this->repo = $repo;

        $this->repo->saveCrew(['name' => $name, 'position' => $position]);

    }

    public function flights()
    {
        return $this->belongsToMany('App\Flight');
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
        return strtolower($this->position);
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = strtolower($position);
    }




}
