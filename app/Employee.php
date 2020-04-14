<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = ['name', 'active'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function format()
    {
        return [
            'employee_id' => $this->id,
            'name' => $this->name,
            'company' => $this->company->name,
            'last_updated' => $this->updated_at->diffForHumans()
        ];
    }
}
