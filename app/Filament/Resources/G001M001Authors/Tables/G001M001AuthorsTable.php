<?php

namespace App\Filament\Resources\G001M001Authors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G001M001AuthorExporter;


class G001M001AuthorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Penulis')
                    ->searchable(),
                TextColumn::make('books_count')
                    ->counts('books')
                    ->label('Buku')
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('contact_person')
                    ->label('Kontak Person')
                    ->placeholder('-')
                    ->copyable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Alamat')
                    ->placeholder('-')
                    ->copyable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
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
                    ->exporter(G001M001AuthorExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                \EightyNine\ExcelImport\ExcelImportAction::make()
                    ->color("primary")
                    ->use(\App\Imports\G001M001AuthorImport::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G001M001AuthorExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
