<?php

namespace App\Filament\Resources\G003M011Sales\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\G003M011SaleExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;

class G003M011SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sale_date')
                    ->label('Tanggal Penjualan')
                    ->sortable(),
                TextColumn::make('location.name')
                    ->label('Lokasi')
                    ->sortable(),
                TextColumn::make('seller.name')
                    ->label('Dijual Oleh')
                    ->sortable(),
                TextColumn::make('items_sum_subtotal')
                    ->sum('items', 'subtotal')
                    ->label('Total')
                    ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                    ->sortable(),
                TextColumn::make('total_margin')
                    ->label('Total Margin')
                    ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                    ->sortable()
                    ->toggleable(),
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
                EditAction::make(),
                \Filament\Actions\Action::make('download_invoice')
                    ->label('Faktur')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($record) {
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.sale_invoice', ['record' => $record]);
                        $pdf->setPaper('a4', 'portrait');

                        $filename = 'Faktur-' . ($record->customer_name ?? 'Guest') . '-' . $record->created_at->format('Ymd') . '.pdf';

                        return response()->streamDownload(
                            fn() => print ($pdf->output()),
                            $filename
                        );
                    }),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(G003M011SaleExporter::class)
                    ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(G003M011SaleExporter::class)
                        ->visible(fn() => auth()->user()->hasRole(['super_admin', 'admin'])),
                ]),
            ]);
    }
}
