<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\standard; 

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['school_id', 'name', 'standard_id', 'gender', 'year', 'photo_path'];

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }
}
