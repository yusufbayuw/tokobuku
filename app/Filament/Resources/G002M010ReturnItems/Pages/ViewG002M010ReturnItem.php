<?php

namespace App\Filament\Resources\G002M010ReturnItems\Pages;

use App\Filament\Resources\G002M010ReturnItems\G002M010ReturnItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewG002M010ReturnItem extends ViewRecord
{
    protected static string $resource = G002M010ReturnItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
