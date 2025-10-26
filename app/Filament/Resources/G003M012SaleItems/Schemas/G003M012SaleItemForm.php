<?php

namespace App\Filament\Resources\G003M012SaleItems\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class G003M012SaleItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('g003_m011_sale_id')
                    ->label('ID Penjualan')
                    ->relationship('sale', 'id'),
                Select::make('g001_m004_book_id')
                    ->label('Judul Buku')
                    ->searchable()
                    ->preload()
                    ->relationship('book', 'title')
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        // Assuming Book model has a 'price' attribute
                        /* $book = \App\Models\G001M004Book::find($state);
                    
                        if ($book) {
                            $book_price = auth()->user()->hasRole('agen') ? $book->agent_price : $book->retail_price;
                            $set('unit_price', $book_price);
                            if ($get('qty')) {
                                $set('subtotal', $get('qty') * $book_price);
                            }
                        } */
                    }),
                TextInput::make('qty')
                    ->label('Jumlah Pembelian')
                    ->numeric()
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        /* $unit_price = $get('unit_price') ?? 0;
                        $set('subtotal', $state * $unit_price); */
                    })
                    ->reactive(),
                TextEntry::make('unit_price')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->reactive()
                    ->inlineLabel()
                    ->placeholder('-'),
                TextEntry::make('subtotal')
                    ->numeric()
                    ->inlineLabel()
                    ->label('Subtotal')
                    ->reactive(),
            ]);
    }
}
