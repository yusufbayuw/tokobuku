<?php

namespace App\Filament\Resources\G001M005AuthorBooks\Pages;

use App\Filament\Resources\G001M005AuthorBooks\G001M005AuthorBookResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG001M005AuthorBook extends EditRecord
{
    protected static string $resource = G001M005AuthorBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
