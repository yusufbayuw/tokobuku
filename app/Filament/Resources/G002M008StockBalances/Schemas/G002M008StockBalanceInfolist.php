<?php

namespace App\Filament\Resources\G002M008StockBalances\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class G002M008StockBalanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('g001_m004_book_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('g002_m007_location_id')
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
