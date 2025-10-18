<?php

namespace App\Filament\Resources\G002M007Locations\Pages;

use App\Filament\Resources\G002M007Locations\G002M007LocationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG002M007Location extends ViewRecord
{
    protected static string $resource = G002M007LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
