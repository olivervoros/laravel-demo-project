<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public $timestamps = true;

    public function aircraft()
    {
        return $this->belongsTo('App\Aircraft');
    }

    public function crews()
    {
        return $this->belongsToMany('App\Crew')->withTimestamps();;
    }

}
