<?php

namespace App\Filament\Resources\G001M001Authors\Pages;

use App\Filament\Resources\G001M001Authors\G001M001AuthorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG001M001Author extends EditRecord
{
    protected static string $resource = G001M001AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
