<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id'  => Company::factory(),
            'name'        => $this->faker->company() . ' Vehicle',
            'plate_number'=> strtoupper($this->faker->bothify('??-####')),
            'model'       => $this->faker->word(),
            'color'       => $this->faker->safeColorName(),
            'active'      => $this->faker->boolean(95),
        ];
    }
}
