<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = ['created_at', 'updated_at']; // Hide timestamps
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
