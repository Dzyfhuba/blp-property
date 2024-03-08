<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\Product;
use App\Models\PublicFacilityOption;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->string()->required(),
                Select::make('category')->label('cluster')->options(Category::all()->pluck('name', 'id')),
                MarkdownEditor::make('description')->columnSpanFull(),
                TextInput::make("price")->label('Price (Rp)')->integer(),
                TextInput::make("bedrooms")->integer(),
                TextInput::make("bathrooms")->integer(),
                TextInput::make("land_size")->label('Land Size (m2)')->integer(),
                Select::make("facility_id")->label('Facility')->options(FacilityOption::all()->pluck('label', 'id')),
                Select::make("public_facility_id")->label('Public Facility')->options(PublicFacilityOption::all()->pluck('label', 'id')),
                Select::make("design_id")->label('Design')->options(DesignOption::all()->pluck('label', 'id')),
                Select::make("location_id")->label('Location')->options(LocationOption::all()->pluck('label', 'id')),
                TextInput::make("floors")->integer(),
                TextInput::make("building_size")->label('Land Size (m2)')->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
