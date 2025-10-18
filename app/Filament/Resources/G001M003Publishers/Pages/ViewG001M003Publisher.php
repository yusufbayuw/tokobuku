<?php

namespace App\Filament\Resources\G001M003Publishers\Pages;

use App\Filament\Resources\G001M003Publishers\G001M003PublisherResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG001M003Publisher extends ViewRecord
{
    protected static string $resource = G001M003PublisherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
