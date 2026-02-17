<?php

namespace App\Filament\Resources\G001M003Publishers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G001M003PublisherExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

class G001M003PublishersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Penerbit')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email Penerbit')
                    ->copyable()
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telepon Penerbit')
                    ->copyable()
                    ->placeholder('-')
                    ->searchable(),
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
                    ->exporter(G001M003PublisherExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                \EightyNine\ExcelImport\ExcelImportAction::make()
                    ->color("primary")
                    ->use(\App\Imports\G001M003PublisherImport::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G001M003PublisherExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
