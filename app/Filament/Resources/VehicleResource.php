<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('plate_number')
                ->label('Plate Number')
                ->unique(ignoreRecord: true) // يمنع التكرار مع استثناء السطر الحالي وقت التعديل
                ->required()
                ->maxLength(20),

            Forms\Components\TextInput::make('model')
                ->label('Model')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('color')
                ->label('Color')
                ->maxLength(100),

            Forms\Components\Toggle::make('active')
                ->label('Active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('plate_number')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('model')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('color'),
            Tables\Columns\IconColumn::make('active')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit'   => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
