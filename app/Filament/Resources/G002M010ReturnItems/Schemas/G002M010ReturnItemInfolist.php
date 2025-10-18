<?php

namespace App\Filament\Resources\G002M010ReturnItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class G002M010ReturnItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('g002_m009_return_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('g001_m004_book_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('qty')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
