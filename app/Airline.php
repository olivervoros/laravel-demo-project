<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{

    /**
     * Get the airline's flights. Has many through
     */
    public function airlineFlights()
    {
        return $this->hasManyThrough('App\Flight', 'App\Aircraft');
    }

    /**
     * Get the base associated with the airline.
     */
    public function base()
    {
        return $this->hasOne('App\Base');
    }

    /**
     * Get the aircrafts for the airline.
     */
    public function aircrafts()
    {
        return $this->hasMany('App\Aircraft');
    }



}
