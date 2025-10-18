<?php

namespace App\Filament\Resources\G001M006CategoryBooks\Pages;

use App\Filament\Resources\G001M006CategoryBooks\G001M006CategoryBookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG001M006CategoryBooks extends ListRecords
{
    protected static string $resource = G001M006CategoryBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
