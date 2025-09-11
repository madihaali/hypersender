<?php

namespace App\Services;

use App\Models\Trip;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class KpiService
{
    public function activeTripsCount(): int
    {
        return Cache::remember('kpi_active_trips', 60, function () {
            return Trip::where('start_time', '<=', now())
                ->where('end_time', '>=', now())
                ->count();
        });
    }

    public function completedTripsThisMonth(): int
    {
        return Cache::remember('kpi_completed_trips', 60, function () {
            return Trip::whereBetween('end_time', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->count();
        });
    }
}