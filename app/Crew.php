<?php


namespace App;

use App\Exceptions\InvalidCrewTypeException;
use App\Exceptions\MissingCrewDataException;
use App\Repositories\CrewRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    private $name;
    private $position;
    private $availablePositions = ['pilot', 'cabincrew'];


    public function addCrew(CrewRepositoryInterface $repo, string $name, string $position)
    {
        if(empty($name) OR empty($position)) {
            throw new MissingCrewDataException("Missing Crew Data...");
        }

        if(!in_array(strtolower($position), $this->availablePositions)) {
            throw new InvalidCrewTypeException("Invalid Crew Type...");
        }

        $this->name = $name;
        $this->position = strtolower($position);

        $result = ($repo->addCrew(['name' => $name, 'position' => $position]));
        return is_null($result) ? $this : $result;

    }

    public function modifyCrew(CrewRepositoryInterface $repo, Crew $crew, string $name, string $position)
    {
        if(empty($name) OR empty($position)) {
            throw new MissingCrewDataException("Missing Crew Data...");
        }

        if(!in_array(strtolower($position), $this->availablePositions)) {
            throw new InvalidCrewTypeException("Invalid Crew Type...");
        }
        $this->name = $name;
        $this->position = strtolower($position);

        $result = $repo->modifyCrew($crew, $name, $position);
        return is_null($result) ? $this : $result;
    }

    public function deleteCrew(CrewRepositoryInterface $repo, int $crewId)
    {
        $result = $repo->deleteCrew($crewId);
        return is_null($result) ? $this : $result;
    }

    public function getCrewByNameAndPosition(CrewRepositoryInterface $repo, string $name, string $position)
    {
        $result = $repo->getCrewByNameAndPosition($name, $position);
        return is_null($result) ? $this : $result;
    }

    public function flights()
    {
        return $this->belongsToMany('App\Flight');
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getPosition()
    {
        return strtolower($this->position);
    }

    public function setPosition($position): void
    {
        $this->position = strtolower($position);
    }




}
