<?php

namespace App\Filament\Resources\G002M010ReturnItems\Pages;

use App\Filament\Resources\G002M010ReturnItems\G002M010ReturnItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG002M010ReturnItems extends ListRecords
{
    protected static string $resource = G002M010ReturnItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //CreateAction::make(),
        ];
    }
}
