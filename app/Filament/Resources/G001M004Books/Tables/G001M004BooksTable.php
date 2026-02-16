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
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('subtitle')
                    ->label('Sub Judul')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->placeholder('-')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('isbn')
                    ->label('ISBN')
                    ->placeholder('-')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('edition')
                    ->label('Edisi')
                    ->placeholder('-')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('language')
                    ->label('Bahasa')
                    ->placeholder('-')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pages')
                    ->label('Jml Halaman')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('year')
                    ->label('Tahun Terbit')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('publisher.name')
                    ->label('Penerbit')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('authors.name')
                    ->label('Penulis')
                    ->placeholder('-')
                    ->wrap()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('retail_price')
                    ->label('Harga Toko')
                    ->placeholder('-')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('agent_price')
                    ->label('Harga Agen')
                    ->placeholder('-')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('min_stock')
                    ->label('Stok Minimal')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stocks_sum_qty')
                    ->sum('stocks', 'qty')
                    ->label('Total Stok')
                    ->placeholder('-')
                    ->suffix(fn($state, $record) => $state < $record->min_stock ? ' ⚠️' : null)
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
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
                //DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
