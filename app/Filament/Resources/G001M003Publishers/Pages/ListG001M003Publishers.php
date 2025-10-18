<?php

namespace App\Filament\Resources\G001M003Publishers\Pages;

use App\Filament\Resources\G001M003Publishers\G001M003PublisherResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG001M003Publishers extends ListRecords
{
    protected static string $resource = G001M003PublisherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
