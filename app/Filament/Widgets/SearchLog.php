<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\SearchLog as SearchLogModel;

class SearchLog extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        // dd($table->query(
        //     SearchLogModel::query()
        // ));
        return $table
            ->query(
                SearchLogModel::query()
            )
            ->columns([
                TextColumn::make('user_ip'),
                TextColumn::make('user_agent')->limit(20),
                TextColumn::make('model_batch'),
                TextColumn::make('criterion'),
                TextColumn::make('total'),
            ]);
    }
}
