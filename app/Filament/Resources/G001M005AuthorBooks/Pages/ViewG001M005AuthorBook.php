<?php

namespace App\Filament\Resources\G001M005AuthorBooks\Pages;

use App\Filament\Resources\G001M005AuthorBooks\G001M005AuthorBookResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG001M005AuthorBook extends ViewRecord
{
    protected static string $resource = G001M005AuthorBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
