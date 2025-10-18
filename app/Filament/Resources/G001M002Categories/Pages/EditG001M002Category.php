<?php

namespace App\Filament\Resources\G001M002Categories\Pages;

use App\Filament\Resources\G001M002Categories\G001M002CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG001M002Category extends EditRecord
{
    protected static string $resource = G001M002CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
