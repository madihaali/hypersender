<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id'     => Company::factory(),
            'name'           => $this->faker->name(),
            'email'          => $this->faker->unique()->safeEmail(),
            'phone'          => $this->faker->unique()->phoneNumber(),
            'license_number' => strtoupper($this->faker->bothify('LIC-####')),
            'active'         => $this->faker->boolean(90),
        ];
    }
}
