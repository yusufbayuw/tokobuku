<?php

namespace App\Filament\Resources\G001M006CategoryBooks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G001M006CategoryBookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('g001_m002_category_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('g001_m004_book_id')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
