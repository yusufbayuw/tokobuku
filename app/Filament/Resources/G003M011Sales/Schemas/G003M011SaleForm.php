<?php

namespace App\Filament\Resources\G003M011Sales\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G003M011SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('g002_m007_location_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('customer_name')
                    ->default(null),
                TextInput::make('total')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
