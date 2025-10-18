<?php

namespace App\Filament\Resources\G002M009Returns\Pages;

use App\Filament\Resources\G002M009Returns\G002M009ReturnResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG002M009Return extends ViewRecord
{
    protected static string $resource = G002M009ReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
