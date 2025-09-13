<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(), // بيتعدل في الـ seeder
            'name' => $this->faker->company . ' Vehicle',
            'plate_number' => strtoupper($this->faker->bothify('??-####')),
            'active' => $this->faker->boolean(80),
        ];
    }
}
