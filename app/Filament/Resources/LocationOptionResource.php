<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationOptionResource\Pages;
use App\Filament\Resources\LocationOptionResource\RelationManagers;
use App\Models\LocationOption;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LocationOptionResource extends Resource
{
    protected static ?string $model = LocationOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    // protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationGroup = 'Product Options';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('label')->required()->unique()->extraInputAttributes(['onKeyUp' => 'this.value = this.value.toLowerCase()']),
                TextInput::make('value')->required()->unique()->extraInputAttributes(['onKeyUp' => 'this.value = this.value.toLowerCase()']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label'),
                TextColumn::make('value'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocationOptions::route('/'),
            'create' => Pages\CreateLocationOption::route('/create'),
            'edit' => Pages\EditLocationOption::route('/{record}/edit'),
        ];
    }
}
