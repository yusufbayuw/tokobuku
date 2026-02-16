<?php

namespace App\Filament\Resources\G002M013StockCorrections\Pages;

use App\Filament\Resources\G002M013StockCorrections\G002M013StockCorrectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG002M013StockCorrection extends ViewRecord
{
    protected static string $resource = G002M013StockCorrectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
