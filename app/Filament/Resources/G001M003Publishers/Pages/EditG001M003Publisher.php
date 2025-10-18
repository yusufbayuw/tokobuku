<?php

namespace App\Filament\Resources\G001M003Publishers\Pages;

use App\Filament\Resources\G001M003Publishers\G001M003PublisherResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG001M003Publisher extends EditRecord
{
    protected static string $resource = G001M003PublisherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
