<?php

namespace App\Filament\Resources\G002M007Locations\Pages;

use App\Filament\Resources\G002M007Locations\G002M007LocationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG002M007Location extends EditRecord
{
    protected static string $resource = G002M007LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
