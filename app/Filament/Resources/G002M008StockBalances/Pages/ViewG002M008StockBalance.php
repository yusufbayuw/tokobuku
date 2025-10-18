<?php

namespace App\Filament\Resources\G002M008StockBalances\Pages;

use App\Filament\Resources\G002M008StockBalances\G002M008StockBalanceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG002M008StockBalance extends ViewRecord
{
    protected static string $resource = G002M008StockBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
