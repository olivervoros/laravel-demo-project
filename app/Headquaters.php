<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headquaters extends Model
{

    public function airline() {
        return $this->belongsTo('App\Airline');
    }

    public function headquaters() {
        return $this->hasOne('App\Address');
    }

    public function groundCrew() {
        return $this->hasMany('App\GroundCrew');
    }
}
