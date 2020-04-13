<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyCertification extends Model
{
    public $timestamps = true;

    public function certificationable()
    {
        return $this->morphTo();
    }

}
