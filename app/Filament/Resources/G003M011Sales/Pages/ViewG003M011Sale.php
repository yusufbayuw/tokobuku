<?php

namespace App\Filament\Resources\G003M011Sales\Pages;

use App\Filament\Resources\G003M011Sales\G003M011SaleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG003M011Sale extends ViewRecord
{
    protected static string $resource = G003M011SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('download_invoice')
                ->label('Download Faktur')
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
            EditAction::make(),
        ];
    }
}
