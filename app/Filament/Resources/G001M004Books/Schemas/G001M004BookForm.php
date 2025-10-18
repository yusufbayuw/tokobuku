<?php

namespace App\Filament\Resources\G001M004Books\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class G001M004BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->default(null),
                TextInput::make('subtitle')
                    ->default(null),
                TextInput::make('sku')
                    ->label('SKU')
                    ->default(null),
                TextInput::make('g001_m003_publisher_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('edition')
                    ->default(null),
                TextInput::make('year')
                    ->default(null),
                TextInput::make('language')
                    ->default(null),
                TextInput::make('pages')
                    ->numeric()
                    ->default(null),
                TextInput::make('cover_photo')
                    ->default(null),
                TextInput::make('retail_price')
                    ->numeric()
                    ->default(null),
                TextInput::make('agent_price')
                    ->numeric()
                    ->default(null),
                TextInput::make('min_stock')
                    ->numeric()
                    ->default(null),
                Toggle::make('active'),
            ]);
    }
}
