<?php

namespace App\Filament\Resources\G002M009Returns\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class G002M009ReturnInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('fromLocation.name')
                    ->label('From location')
                    ->placeholder('-'),
                TextEntry::make('toLocation.name')
                    ->label('To location')
                    ->placeholder('-'),
                TextEntry::make('handled_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('return_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('note')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
