<?php

namespace App\Filament\Resources\G001M002Categories\Pages;

use App\Filament\Resources\G001M002Categories\G001M002CategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG001M002Category extends ViewRecord
{
    protected static string $resource = G001M002CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
