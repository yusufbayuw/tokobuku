<?php

namespace App\Filament\Resources\G002M007Locations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G002M007LocationExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

class G002M007LocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lokasi')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('type')
                    ->placeholder('-')
                    ->label('Tipe Lokasi')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->placeholder('-')
                    ->label('Penanggung Jawab')
                    ->searchable(),
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
            ->headerActions([
                ExportAction::make()
                    ->exporter(G002M007LocationExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G002M007LocationExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
