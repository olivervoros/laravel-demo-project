<?php


namespace App\Repositories;

use App\Crew;

interface CrewRepositoryInterface
{
    public function getAll();
    public function getAllPilots();
    public function getAllCabinCrews();
    public function saveCrew(array $crew);
    public function getCrewByName($name);
}
