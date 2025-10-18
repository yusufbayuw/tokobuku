<?php

namespace App\Filament\Resources\G001M005AuthorBooks\Pages;

use App\Filament\Resources\G001M005AuthorBooks\G001M005AuthorBookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG001M005AuthorBooks extends ListRecords
{
    protected static string $resource = G001M005AuthorBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
