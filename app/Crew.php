<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{

    public function flights()
    {
        return $this->belongsToMany('App\Flight');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }

    public function schedules()
    {
        return $this->morphToMany('App\Schedule', 'schedulable');
    }

}
