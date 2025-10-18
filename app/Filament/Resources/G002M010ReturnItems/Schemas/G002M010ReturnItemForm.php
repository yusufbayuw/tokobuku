<?php

namespace App\Filament\Resources\G002M010ReturnItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G002M010ReturnItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('g002_m009_return_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('g001_m004_book_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('qty')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
