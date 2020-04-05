<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function headquaters() {

        return $this->belongsTo('App\Headquaters');

    }
}
