<?php

namespace App\Filament\Resources\G001M006CategoryBooks\Pages;

use App\Filament\Resources\G001M006CategoryBooks\G001M006CategoryBookResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG001M006CategoryBook extends ViewRecord
{
    protected static string $resource = G001M006CategoryBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
