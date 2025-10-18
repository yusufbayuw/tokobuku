<?php

namespace App\Filament\Resources\G002M008StockBalances\Pages;

use App\Filament\Resources\G002M008StockBalances\G002M008StockBalanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG002M008StockBalances extends ListRecords
{
    protected static string $resource = G002M008StockBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
