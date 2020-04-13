<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = true;

    public function crews()
    {
        return $this->morphedByMany('App\Crew', 'schedulable');
    }

    public function flights()
    {
        return $this->morphedByMany('App\Flight', 'schedulable');
    }

}
