<?php

namespace App\Filament\Resources\G003M012SaleItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class G003M012SaleItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sale.location.name')
                    ->label('Lokasi')
                    ->searchable(),
                TextColumn::make('book.title')
                    ->label('Buku')
                    ->searchable(),
                TextColumn::make('unit_price')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('qty')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                //EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
