<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{

    public function aircraft()
    {
        return $this->belongsTo('App\Aircraft');
    }

    public function crew()
    {
        return $this->belongsToMany('App\Crew');
    }

}
