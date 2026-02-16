<?php

namespace App\Filament\Resources\G002M013StockCorrections\Pages;

use App\Filament\Resources\G002M013StockCorrections\G002M013StockCorrectionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG002M013StockCorrection extends EditRecord
{
    protected static string $resource = G002M013StockCorrectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
