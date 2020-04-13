<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    public $timestamps = true;

    public function aircraftType() {
        return $this->belongsTo('App\aircraftType');
    }

    public function airline()
    {
        return $this->belongsTo('App\Airline');
    }

    public function flights()
    {
        return $this->hasMany('App\Flight');
    }

    public function logs()
    {
        return $this->morphMany('App\Log', 'loggable');
    }



}
