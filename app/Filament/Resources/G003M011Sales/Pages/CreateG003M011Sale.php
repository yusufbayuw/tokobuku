<?php

namespace App\Filament\Resources\G003M011Sales\Pages;

use App\Filament\Resources\G003M011Sales\G003M011SaleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateG003M011Sale extends CreateRecord
{
    protected static string $resource = G003M011SaleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }
}
