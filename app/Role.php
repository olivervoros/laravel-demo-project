<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Get the users that belongs to the role.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
