<?php

namespace App\Filament\Resources\G003M012SaleItems\Pages;

use App\Filament\Resources\G003M012SaleItems\G003M012SaleItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG003M012SaleItem extends EditRecord
{
    protected static string $resource = G003M012SaleItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
