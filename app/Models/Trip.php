<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Rules\NoOverlapTrip;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'driver_id',
        'vehicle_id',
        'start_time',
        'end_time',
    ];

    protected static function booted()
    {
        // نشغل التحقق بس في الحالة العادية مش أثناء الـ seeding / factories
        if (! app()->runningInConsole()) {
            static::creating(function ($trip) {
                $validator = Validator::make($trip->toArray(), [
                    'driver_id' => [
                        new NoOverlapTrip(
                            $trip->start_time,
                            $trip->end_time,
                            'driver',
                            $trip->driver_id
                        ),
                    ],
                    'vehicle_id' => [
                        new NoOverlapTrip(
                            $trip->start_time,
                            $trip->end_time,
                            'vehicle',
                            $trip->vehicle_id
                        ),
                    ],
                ]);

                if ($validator->fails()) {
                    throw new \Illuminate\Validation\ValidationException($validator);
                }
            });
        }
    }

    // العلاقات
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
