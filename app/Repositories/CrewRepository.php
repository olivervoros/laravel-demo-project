<?php


namespace App\Repositories;

use App\Crew;
use Illuminate\Support\Facades\DB;


class CrewRepository implements CrewRepositoryInterface
{

    public function saveCrew(array $crew)
    {
        if(!empty($crew)) {
            return DB::table('crews')->insertGetId($crew);
        }
    }

}
