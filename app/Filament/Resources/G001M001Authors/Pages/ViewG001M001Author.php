<?php

namespace App\Filament\Resources\G001M001Authors\Pages;

use App\Filament\Resources\G001M001Authors\G001M001AuthorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG001M001Author extends ViewRecord
{
    protected static string $resource = G001M001AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
