<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flightreview extends Model
{

    public $timestamps = true;

    protected $fillable = ['passenger_id', 'airline', 'flight_number', 'review_points', 'review_title', 'review_body'];

    public function passenger()
    {
        return $this->belongsTo('App\Passenger');
    }

}
