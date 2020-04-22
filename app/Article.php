<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    /**
     * Get the role that belongs to the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
