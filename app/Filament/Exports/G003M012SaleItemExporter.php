<?php

namespace App\Filament\Exports;

use App\Models\G003M012SaleItem;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class G003M012SaleItemExporter extends Exporter
{
    protected static ?string $model = G003M012SaleItem::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('g003_m011_sale_id'),
            ExportColumn::make('g001_m004_book_id'),
            ExportColumn::make('unit_price'),
            ExportColumn::make('consumer_price'),
            ExportColumn::make('discount'),
            ExportColumn::make('margin'),
            ExportColumn::make('qty'),
            ExportColumn::make('subtotal'),
            ExportColumn::make('subtotal_margin'),
            ExportColumn::make('is_correction'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your g003 m012 sale item export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
