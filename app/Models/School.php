<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class School extends Model
{
    protected $fillable = [
        'name', 'address', 'state_id', 'district_id', 'city_id',
        'establishment_date', 'contact_number', 'login_id'
    ];

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function photos()
    {
        return $this->hasMany(SchoolPhoto::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
