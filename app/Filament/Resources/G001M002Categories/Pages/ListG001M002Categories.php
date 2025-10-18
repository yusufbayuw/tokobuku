<?php

namespace App\Filament\Resources\G001M002Categories\Pages;

use App\Filament\Resources\G001M002Categories\G001M002CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG001M002Categories extends ListRecords
{
    protected static string $resource = G001M002CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
