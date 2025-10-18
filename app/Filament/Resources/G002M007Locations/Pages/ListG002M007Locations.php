<?php

namespace App\Filament\Resources\G002M007Locations\Pages;

use App\Filament\Resources\G002M007Locations\G002M007LocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG002M007Locations extends ListRecords
{
    protected static string $resource = G002M007LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
