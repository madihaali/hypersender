<?php

namespace App\Filament\Widgets;

use App\Services\KpiService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class KpiStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        $kpi = app(KpiService::class);

        return [
            Card::make('Active Trips', $kpi->activeTripsCount())
                ->description('Currently ongoing')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),

            Card::make('Completed Trips (This Month)', $kpi->completedTripsThisMonth())
                ->description('Trips ended this month')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
