<?php

namespace App\Filament\Resources\G001M006CategoryBooks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G001M006CategoryBookExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

class G001M006CategoryBooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('g001_m002_category_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('g001_m004_book_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
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
                    ->exporter(G001M006CategoryBookExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G001M006CategoryBookExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
