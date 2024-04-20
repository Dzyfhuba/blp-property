<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CriterionRatingResource\Pages;
use App\Filament\Resources\CriterionRatingResource\RelationManagers;
use App\Models\CriterionRating;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CriterionRatingResource extends Resource
{
    protected static ?string $model = CriterionRating::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Search Engine';

    public static function form(Form $form): Form
    {
        $columns = [
            'price' => 'price',
            'bedrooms' => 'bedrooms',
            'bathrooms' => 'bathrooms',
            'floors' => 'floors',
            'facility' => 'facility',
            'public_facility' => 'public facility',
            'land_size' => 'land size',
            'building_size' => 'building size',
            'location' => 'location',
            'design' => 'design',
        ];

        return $form
            ->schema([
                Select::make('criteria')
                    ->options($columns)
                    ->required(),
                Repeater::make('rating')
                    ->schema([
                        TextInput::make('range')->required(),
                        TextInput::make('label')->required(),
                        TextInput::make('value')->required(),
                    ])
                    ->required()
                    ->columns(3)
                    ->minItems(2)
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('criteria')
                    ->description(fn(CriterionRating $criterionRating): string => implode('; ', array_map(fn($row) => $row['label'] . ' | ' . $row['range'] . ' - ' . $row['value'], $criterionRating->rating))),
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
            'index' => Pages\ListCriterionRatings::route('/'),
            'create' => Pages\CreateCriterionRating::route('/create'),
            'edit' => Pages\EditCriterionRating::route('/{record}/edit'),
        ];
    }
}
