<?php

namespace App\Filament\Resources\G001M004Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class G001M004BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->placeholder('-')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('publisher.name')
                    ->label('Penerbit')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('authors.name')
                    ->label('Penulis')
                    ->placeholder('-')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('retail_price')
                    ->label('Harga Toko')
                    ->placeholder('-')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('agent_price')
                    ->label('Harga Agen')
                    ->placeholder('-')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stocks_sum_qty')
                    ->sum('stocks', 'qty')
                    ->label('Stok')
                    ->placeholder('-')
                    ->suffix(fn ($state, $record) => $state < $record->min_stock ? ' ⚠️' : null)
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // 
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
