<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }

    public function run(): void
{
    \App\Models\Company::factory(3)->create()->each(function ($company) {
        $drivers = \App\Models\Driver::factory(5)->create([
            'company_id' => $company->id,
        ]);

        $vehicles = \App\Models\Vehicle::factory(5)->create([
            'company_id' => $company->id,
        ]);

        \App\Models\Trip::factory(10)->create([
            'company_id' => $company->id,
            'driver_id' => $drivers->random()->id,
            'vehicle_id' => $vehicles->random()->id,
        ]);
    });
}

}
