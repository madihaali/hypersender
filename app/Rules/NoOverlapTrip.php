<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Trip;

class NoOverlapTrip implements Rule
{
    protected $start;
    protected $end;
    protected $type;
    protected $id;

    public function __construct($start, $end, $type, $id)
    {
        $this->start = $start;
        $this->end = $end;
        $this->type = $type; // driver or vehicle
        $this->id = $id;
    }

    public function passes($attribute, $value): bool
    {
        return !Trip::where($this->type . '_id', $this->id)
            ->where(function ($q) {
                $q->whereBetween('start_time', [$this->start, $this->end])
                  ->orWhereBetween('end_time', [$this->start, $this->end])
                  ->orWhere(function ($q2) {
                      $q2->where('start_time', '<=', $this->start)
                          ->where('end_time', '>=', $this->end);
                  });
            })
            ->exists();
    }

    public function message(): string
    {
        return ucfirst($this->type) . ' is already booked during this time.';
    }
}