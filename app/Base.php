<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    /**
     * Get the airline that owns the base.
     */
    public function airline()
    {
        return $this->belongsTo('App\Airline');
    }
}
