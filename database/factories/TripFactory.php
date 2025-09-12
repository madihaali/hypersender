<?php
namespace Database\Factories;

use App\Models\{Company, Driver, Vehicle};
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TripFactory extends Factory
{
    public function definition(): array
    {
        // كل رحلة مدتها ساعتين
        $start = Carbon::now()->addDays(rand(1, 30))->setTime(rand(6, 18), 0);
        $end   = (clone $start)->addHours(2);

        return [
            'company_id' => Company::factory(),
            'driver_id' => Driver::factory(),
            'vehicle_id' => Vehicle::factory(),
            'start_time' => $start,
            'end_time' => $end,
        ];
    }
}
