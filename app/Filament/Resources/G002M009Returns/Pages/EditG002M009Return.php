<?php

namespace App\Filament\Resources\G002M009Returns\Pages;

use App\Filament\Resources\G002M009Returns\G002M009ReturnResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG002M009Return extends EditRecord
{
    protected static string $resource = G002M009ReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
