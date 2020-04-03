<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{



    public function pilots()
    {
        return $this->belongsToMany('App\Pilot');
    }

    public function cabincrews()
    {
        return $this->belongsToMany('App\Cabincrew');
    }

}
