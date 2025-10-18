<?php

namespace App\Filament\Resources\G003M012SaleItems\Pages;

use App\Filament\Resources\G003M012SaleItems\G003M012SaleItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG003M012SaleItem extends ViewRecord
{
    protected static string $resource = G003M012SaleItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
