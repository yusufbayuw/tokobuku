<?php

namespace App\Filament\Resources\G003M011Sales\Pages;

use App\Filament\Resources\G003M011Sales\G003M011SaleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG003M011Sales extends ListRecords
{
    protected static string $resource = G003M011SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
