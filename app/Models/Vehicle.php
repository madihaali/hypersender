<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

       protected $fillable = [
        'company_id',
        'name',
        'plate_number',
        'active',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'driver_vehicle');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}