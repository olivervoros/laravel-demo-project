<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{

    public function headquaters() {
        return $this->hasOne('App\Headquaters');
    }

    public function airlineFlights()
    {
        return $this->hasManyThrough('App\Flight', 'App\Aircraft');
    }

    public function aircrafts()
    {
        return $this->hasMany('App\Aircraft');
    }



}
