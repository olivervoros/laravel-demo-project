<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function pilots()
    {
        return $this->morphedByMany('App\Pilot', 'schedulable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function cabincrews()
    {
        return $this->morphedByMany('App\Cabincrew', 'schedulable');
    }

}
