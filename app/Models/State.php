<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $hidden = ['created_at', 'updated_at']; // Hide timestamps
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
