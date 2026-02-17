<?php

namespace App\Filament\Resources\G002M010ReturnItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G002M010ReturnItemExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

class G002M010ReturnItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book.title')
                    ->label('Buku')
                    ->searchable(),
                TextColumn::make('qty')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('retur.return_date')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('retur.fromLocation.name')
                    ->label('Lokasi Pengirim')
                    ->searchable(),
                TextColumn::make('retur.toLocation.name')
                    ->label('Lokasi Penerima')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i:s')
                    ->label('Tanggal Dibuat')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i:s')
                    ->label('Tanggal Diperbarui')
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
            ->headerActions([
                ExportAction::make()
                    ->exporter(G002M010ReturnItemExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G002M010ReturnItemExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
