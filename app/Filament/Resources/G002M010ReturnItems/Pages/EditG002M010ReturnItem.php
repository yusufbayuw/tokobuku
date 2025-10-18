<?php

namespace App\Filament\Resources\G002M010ReturnItems\Pages;

use App\Filament\Resources\G002M010ReturnItems\G002M010ReturnItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG002M010ReturnItem extends EditRecord
{
    protected static string $resource = G002M010ReturnItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
