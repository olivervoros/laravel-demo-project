<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    public $timestamps = true;

    public function flights()
    {
        return $this->belongsToMany('App\Flight')->withTimestamps();;
    }

    public function safetyCertification()
    {
        return $this->morphOne('App\SafetyCertification', 'certificationable');
    }

    public function logs()
    {
        return $this->morphMany('App\Log', 'loggable');
    }

    public function schedules()
    {
        return $this->morphToMany('App\Schedule', 'schedulable');
    }

}
