<?php

namespace App\Filament\Resources\G002M008StockBalances\Pages;

use App\Filament\Resources\G002M008StockBalances\G002M008StockBalanceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG002M008StockBalance extends EditRecord
{
    protected static string $resource = G002M008StockBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
