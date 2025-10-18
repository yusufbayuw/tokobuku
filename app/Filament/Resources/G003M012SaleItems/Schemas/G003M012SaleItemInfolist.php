<?php

namespace App\Filament\Resources\G003M012SaleItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class G003M012SaleItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('g003_m011_sale_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('g001_m004_book_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('unit_price')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('qty')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('subtotal')
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
