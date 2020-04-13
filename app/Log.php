<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = true;

    public function loggable()
    {
        return $this->morphTo();
    }

}
