<?php

namespace App\Filament\Resources\G001M005AuthorBooks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G001M005AuthorBookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('g001_m004_book_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('g001_m001_author_id')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
