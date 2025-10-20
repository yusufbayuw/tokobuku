<?php

namespace App\Filament\Resources\G003M012SaleItems\Pages;

use App\Filament\Resources\G003M012SaleItems\G003M012SaleItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG003M012SaleItems extends ListRecords
{
    protected static string $resource = G003M012SaleItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //CreateAction::make(),
        ];
    }
}
