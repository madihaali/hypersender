<?php

namespace Database\Factories;

use App\Models\{Company, Driver, Vehicle};
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TripFactory extends Factory
{
    public function definition(): array
    {
        $start = Carbon::now()->addHours(rand(1, 72));
        $end = (clone $start)->addHours(rand(1, 6));

        return [
            'company_id' => Company::factory(),
            'driver_id' => Driver::factory(),
            'vehicle_id' => Vehicle::factory(),
            'start_time' => $start,
            'end_time' => $end,
        ];
    }
}