<?php

namespace App\Filament\Resources\G003M011Sales\Pages;

use App\Filament\Resources\G003M011Sales\G003M011SaleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG003M011Sale extends ViewRecord
{
    protected static string $resource = G003M011SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
