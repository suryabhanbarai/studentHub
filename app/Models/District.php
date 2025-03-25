<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City; 
use App\Models\State; 

class District extends Model
{
    protected $hidden = ['created_at', 'updated_at']; // Hide timestamps
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
