<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\SchoolPhoto; 
use App\Models\Student; 
use App\Models\State; 
use App\Models\District; 
use App\Models\City; 
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'address', 'state_id', 'district_id', 'city_id',
        'establishment_date', 'contact_number', 'login_id'
    ];
    protected $dates = ['deleted_at'];

    public function photos()
    {
        return $this->hasMany(SchoolPhoto::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function district()
    {
        return $this->belongsTo(district::class, 'district_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
