<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    /**
     * Get the users that belongs to the role.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
