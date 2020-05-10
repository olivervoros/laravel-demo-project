<?php


namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class CrewRepository implements CrewRepositoryInterface
{

    public function getAll() {
        return DB::select('select * from crews');
    }

    public function saveCrew(array $crew)
    {
        if(!empty($crew)) {
            return DB::table('crews')->insertGetId($crew);
        }
    }

    public function getAllPilots() {
        return DB::select('select * from crews where position = ?', ['pilot']);
    }

    public function getAllCabinCrews() {
        return DB::select('select * from crews where position = ?', ['cabincrew']);
    }

    public function getCrewByName($name) {
        return DB::select('select * from crews where name = ?', [$name]);
    }

}
