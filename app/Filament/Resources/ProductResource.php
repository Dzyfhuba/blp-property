<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\CriterionRating;
use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\Product;
use App\Models\PublicFacilityOption;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Products';

    public static function form(Form $form): Form
    {
        $facility = collect(CriterionRating::query()->where('criteria', 'facility')->first('rating')->rating)->mapWithKeys(fn($record) => [$record['value'] => "{$record['label']}: {$record['range']}"]);
        $publicFacility = collect(CriterionRating::query()->where('criteria', 'public_facility')->first('rating')->rating)->mapWithKeys(fn($record) => [$record['value'] => "{$record['label']}: {$record['range']}"]);
        // dd(collect(CriterionRating::query()->where('criteria', 'public_facility')->first('rating')->rating)->mapWithKeys(fn($record) => [$record['value'] => "{$record['label']}: {$record['range']}"]));
        $design = collect(CriterionRating::query()->where('criteria', 'design')->first('rating')->rating)->mapWithKeys(fn($record) => [$record['value'] => "{$record['label']}: {$record['range']}"]);
        $location = collect(CriterionRating::query()->where('criteria', 'location')->first('rating')->rating)->mapWithKeys(fn($record) => [$record['value'] => "{$record['label']}: {$record['range']}"]);
        return $form
            ->schema([
                TextInput::make('name')->string()->required(),
                Select::make('category')->label('cluster')->options(Category::all()->pluck('name', 'id'))->relationship('category', 'name'),
                MarkdownEditor::make('description')->columnSpanFull(),
                TextInput::make("occupied")->label('Jumlah Terisi')->integer(),
                TextInput::make("capacity")->label('Kapasitas')->integer(),
                TextInput::make("price")->label('Price (Rp)')->integer(),
                TextInput::make("bedrooms")->integer(),
                TextInput::make("bathrooms")->integer(),
                TextInput::make("land_size")->label('Land Size (m2)')->integer(),
                Select::make("facility_option_id")->label('Facility')->options($facility),
                Select::make("public_facility_option_id")->label('Public Facility')->options($publicFacility),
                Select::make("design_option_id")->label('Design')->options($design),
                Select::make("location_option_id")->label('Location')->options($location),
                TextInput::make("floors")->integer(),
                TextInput::make("building_size")->label('Land Size (m2)')->integer(),
                FileUpload::make('images')->image()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name'),
                TextColumn::make('name'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
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
