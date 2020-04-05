<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyCertification extends Model
{

    public function certificationable()
    {
        return $this->morphTo();
    }

}
