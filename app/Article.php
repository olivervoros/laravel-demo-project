<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where([['id', $value],['published', 1]])->firstOrFail();
    }
}
