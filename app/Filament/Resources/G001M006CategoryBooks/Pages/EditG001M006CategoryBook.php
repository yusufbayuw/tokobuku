<?php

namespace App\Filament\Resources\G001M006CategoryBooks\Pages;

use App\Filament\Resources\G001M006CategoryBooks\G001M006CategoryBookResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG001M006CategoryBook extends EditRecord
{
    protected static string $resource = G001M006CategoryBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
