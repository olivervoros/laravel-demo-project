<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{

    public function airline()
    {
        return $this->belongsTo('App\Airline');
    }

    public function flights()
    {
        return $this->hasMany('App\Flight');
    }

}
