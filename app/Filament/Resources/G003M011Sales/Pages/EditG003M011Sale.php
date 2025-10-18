<?php

namespace App\Filament\Resources\G003M011Sales\Pages;

use App\Filament\Resources\G003M011Sales\G003M011SaleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditG003M011Sale extends EditRecord
{
    protected static string $resource = G003M011SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
