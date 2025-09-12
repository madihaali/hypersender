<?php
// app/Providers/Filament/AdminPanelProvider.php
namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')   // كل الـ routes هتبقى تحت /admin
            ->login()         // يضيف صفحة اللوجين
            ->resources([
                \App\Filament\Resources\CompanyResource::class,
                \App\Filament\Resources\DriverResource::class,
                \App\Filament\Resources\VehicleResource::class,
                \App\Filament\Resources\TripResource::class,
            ])
            ->pages([
                \App\Filament\Pages\Availability::class, // صفحة التوافر
            ]);
    }
}
