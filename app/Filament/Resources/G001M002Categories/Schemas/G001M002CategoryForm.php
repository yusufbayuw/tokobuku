<?php

namespace App\Filament\Resources\G001M002Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G001M002CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->default(null),
                TextInput::make('description')
                    ->label('Deskripsi')
                    ->default(null),
            ]);
    }
}
