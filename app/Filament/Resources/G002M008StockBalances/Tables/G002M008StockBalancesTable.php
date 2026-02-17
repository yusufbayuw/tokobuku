<?php

namespace App\Filament\Resources\G002M008StockBalances\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use App\Filament\Exports\G002M008StockBalanceExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

class G002M008StockBalancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book.title')
                    ->label('Judul Buku')
                    ->searchable(),
                TextColumn::make('location.name')
                    ->label('Lokasi Buku')
                    ->badge()
                    ->searchable(),
                TextColumn::make('qty')
                    ->label('Kuantitas')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime('d M Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // filter berdasarkan lokasi buku
                SelectFilter::make('location_id')
                    ->label('Lokasi Buku')
                    ->relationship('location', 'name'),
            ])
            ->groups([
                Group::make('book.title')
                    ->label('Buku'),
                Group::make('location.name')
                    ->label('Lokasi'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(G002M008StockBalanceExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),

                \Filament\Actions\Action::make('downloadTemplate')
                    ->label('Download Template')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\TemplateStockBalanceExport, 'template_stock_balances.xlsx'))
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),

                \EightyNine\ExcelImport\ExcelImportAction::make()
                    ->color("primary")
                    ->use(\App\Imports\G002M008StockBalanceImport::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    //DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G002M008StockBalanceExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
