<?php


namespace App;

use App\Exceptions\InvalidCrewTypeException;
use App\Repositories\CrewRepository;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    private $name;
    private $position;
    private $availablePositions = ['pilot', 'cabincrew'];

    /**
     * Crew constructor.
     * @param CrewRepository $repo
     * @param string $name
     * @param string $position
     * @return Crew
     * @throws InvalidCrewTypeException
     */
    public function saveCrew(CrewRepository $repo = null, string $name = '', string $position= '')
    {
        if(!in_array(strtolower($position), $this->availablePositions)) {
            throw new InvalidCrewTypeException("Invalid Crew Type...");
        }
        $this->name = $name;
        $this->position = strtolower($position);

        $result = ($repo->saveCrew(['name' => $name, 'position' => $position]));
        return is_null($result) ? $this : $result;

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
