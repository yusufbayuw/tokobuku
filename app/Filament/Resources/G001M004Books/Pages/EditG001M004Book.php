<?php

namespace App\Filament\Resources\G001M004Books\Pages;

use App\Filament\Resources\G001M004Books\G001M004BookResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG001M004Book extends EditRecord
{
    protected static string $resource = G001M004BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
