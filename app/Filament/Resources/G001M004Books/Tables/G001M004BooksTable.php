<?php

namespace App\Filament\Resources\G001M004Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G001M004BookExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

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
                    ->wrap()
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
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('isbn')
                    ->label('ISBN')
                    ->placeholder('-')
                    ->searchable()
                    ->toggleable(),
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
                    ->sortable()
                    ->toggleable(),
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
            ->headerActions([
                ExportAction::make()
                    ->exporter(G001M004BookExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                \EightyNine\ExcelImport\ExcelImportAction::make()
                    ->color("primary")
                    ->use(\App\Imports\G001M004BookImport::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G001M004BookExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
