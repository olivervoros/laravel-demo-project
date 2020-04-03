<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabincrew extends Model
{

    public function flights()
    {
        return $this->belongsToMany('App\Flight');
    }

    public function schedules()
    {
        return $this->morphToMany('App\Schedule', 'schedulable');
    }

}
