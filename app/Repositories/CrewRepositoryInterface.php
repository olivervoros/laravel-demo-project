<?php

namespace App\Repositories;

use App\Crew;

interface CrewRepositoryInterface
{
    public function getAll();

    public function addCrew(array $crew);

    public function modifyCrew(Crew $crew, $name, $position);

    public function deleteCrew(int $crewId);

    public function getCrewByNameAndPosition(string $name, string $position);

    public function getAllPilots();

    public function getAllCabinCrews();

    public function getCrewByName($name);
}
