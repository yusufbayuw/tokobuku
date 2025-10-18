<?php

namespace App\Filament\Resources\G001M004Books\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class G001M004BookInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('subtitle')
                    ->placeholder('-'),
                TextEntry::make('sku')
                    ->label('SKU')
                    ->placeholder('-'),
                TextEntry::make('g001_m003_publisher_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('edition')
                    ->placeholder('-'),
                TextEntry::make('year')
                    ->placeholder('-'),
                TextEntry::make('language')
                    ->placeholder('-'),
                TextEntry::make('pages')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('cover_photo')
                    ->placeholder('-'),
                TextEntry::make('retail_price')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('agent_price')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('min_stock')
                    ->numeric()
                    ->placeholder('-'),
                IconEntry::make('active')
                    ->boolean()
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
