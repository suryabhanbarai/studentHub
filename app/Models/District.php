<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City; 
use App\Models\State; 

class District extends Model
{
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
