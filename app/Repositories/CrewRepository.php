<?php


namespace App\Repositories;

use App\Crew;
use Illuminate\Support\Facades\DB;


class CrewRepository implements CrewRepositoryInterface, CrewRepositoryInterface
{

    public function getAll() {
        return DB::select('select * from crews');
    }

    public function saveCrew(array $crew)
    {
        if(!empty($crew)) {
            $insertedId =  DB::table('crews')->insertGetId($crew);
            return Crew::find($insertedId);
        }
    }

    public function modifyCrew(Crew $crew, $name, $position)
    {
        DB::table('crews')->where('id', $crew->id)->update(['name' => $name, 'position' => $position]);
        return Crew::find($crew->id);
    }

    public function deleteCrew(int $crewId)
    {
        DB::table('crews')->where('id', $crewId)->delete();
    }

    public function getCrewByNameAndPosition(string $name, string $position)
    {
        return DB::table('crews')->where(['name' => $name, 'position' => $position])->get()->first();
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
