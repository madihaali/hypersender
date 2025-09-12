<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Models\Trip;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;
    protected static ?string $navigationGroup = 'Operations';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required(),
            Forms\Components\Select::make('driver_id')
                ->relationship('driver', 'name')
                ->required(),
            Forms\Components\Select::make('vehicle_id')
                ->relationship('vehicle', 'name')
                ->required(),
            Forms\Components\DateTimePicker::make('start_time')->required(),
            Forms\Components\DateTimePicker::make('end_time')->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('company.name'),
            Tables\Columns\TextColumn::make('driver.name'),
            Tables\Columns\TextColumn::make('vehicle.name'),
            Tables\Columns\TextColumn::make('start_time')->dateTime(),
            Tables\Columns\TextColumn::make('end_time')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
