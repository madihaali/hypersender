<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Trip;
use Carbon\Carbon;

class Availability extends Page
{
    protected static ?string $navigationGroup = 'Operations';
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static string $view = 'filament.pages.availability';

    public $start;
    public $end;
    public $drivers = [];
    public $vehicles = [];

    public function submit()
    {
        $start = Carbon::parse($this->start);
        $end = Carbon::parse($this->end);

        $this->drivers = Driver::whereDoesntHave('trips', function ($q) use ($start, $end) {
            $q->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                      ->orWhereBetween('end_time', [$start, $end])
                      ->orWhere(function ($q2) use ($start, $end) {
                          $q2->where('start_time', '<=', $start)
                             ->where('end_time', '>=', $end);
                      });
            });
        })->get();

        $this->vehicles = Vehicle::whereDoesntHave('trips', function ($q) use ($start, $end) {
            $q->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                      ->orWhereBetween('end_time', [$start, $end])
                      ->orWhere(function ($q2) use ($start, $end) {
                          $q2->where('start_time', '<=', $start)
                             ->where('end_time', '>=', $end);
                      });
            });
        })->get();
    }
}
