<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Company, Driver, Vehicle, Trip};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Company::factory()
            ->count(3)
            ->has(Driver::factory()->count(5))
            ->has(Vehicle::factory()->count(5))
            ->create()
            ->each(function ($company) {
                Trip::factory()->count(10)->create([
                    'company_id' => $company->id,
                ]);
            });
    }
}