<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroundCrew extends Model
{

    public function headquaters()
    {
        return $this->belongsTo('App\Headquaters');
    }

    public function safetyCertification()
    {
        return $this->morphOne('App\SafetyCertification', 'certificationable');
    }

}
