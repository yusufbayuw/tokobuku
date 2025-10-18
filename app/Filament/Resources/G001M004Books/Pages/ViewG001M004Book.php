<?php

namespace App\Filament\Resources\G001M004Books\Pages;

use App\Filament\Resources\G001M004Books\G001M004BookResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG001M004Book extends ViewRecord
{
    protected static string $resource = G001M004BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
