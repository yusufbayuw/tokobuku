<?php

namespace App\Filament\Resources\G002M013StockCorrections\Pages;

use App\Filament\Resources\G002M013StockCorrections\G002M013StockCorrectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG002M013StockCorrections extends ListRecords
{
    protected static string $resource = G002M013StockCorrectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
