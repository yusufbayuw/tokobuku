<?php

namespace App\Filament\Resources\G002M009Returns\Pages;

use App\Filament\Resources\G002M009Returns\G002M009ReturnResource;
use Filament\Resources\Pages\CreateRecord;

class CreateG002M009Return extends CreateRecord
{
    protected static string $resource = G002M009ReturnResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }
}
