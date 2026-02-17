<?php

namespace App\Filament\Exports;

use App\Models\G001M004Book;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class G001M004BookExporter extends Exporter
{
    protected static ?string $model = G001M004Book::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('title'),
            ExportColumn::make('subtitle'),
            ExportColumn::make('isbn'),
            ExportColumn::make('sku')
                ->label('SKU'),
            ExportColumn::make('g001_m003_publisher_id'),
            ExportColumn::make('edition'),
            ExportColumn::make('year'),
            ExportColumn::make('language'),
            ExportColumn::make('pages'),
            ExportColumn::make('cover_photo'),
            ExportColumn::make('retail_price'),
            ExportColumn::make('agent_price'),
            ExportColumn::make('min_stock'),
            ExportColumn::make('active'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your g001 m004 book export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
