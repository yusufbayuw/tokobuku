<?php

namespace App\Filament\Resources\G002M013StockCorrections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G002M013StockCorrectionExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

class G002M013StockCorrectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('substraction')
                    ->label('Jenis Koreksi')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedMinus)
                    ->falseIcon(Heroicon::OutlinedPlus),
                TextColumn::make('qty')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('note')
                    ->label('Catatan')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('created_at')
                    ->label('Diinput pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('updated_at')
                    ->label('Diupdate pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //ViewAction::make(),
                //EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(G002M013StockCorrectionExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    //DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G002M013StockCorrectionExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
