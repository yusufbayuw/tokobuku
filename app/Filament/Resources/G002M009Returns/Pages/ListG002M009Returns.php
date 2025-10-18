<?php

namespace App\Filament\Resources\G002M009Returns\Pages;

use App\Filament\Resources\G002M009Returns\G002M009ReturnResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG002M009Returns extends ListRecords
{
    protected static string $resource = G002M009ReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
