<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DriverResource\Pages;
use App\Models\Driver;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;
    protected static ?string $navigationGroup = 'Company Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required(),
            Forms\Components\Select::make('vehicles')
                ->multiple()
                ->relationship('vehicles', 'name'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('company.name'),
            Tables\Columns\TextColumn::make('vehicles.name')->badge(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDrivers::route('/'),
            'create' => Pages\CreateDriver::route('/create'),
            'edit' => Pages\EditDriver::route('/{record}/edit'),
        ];
    }
}
