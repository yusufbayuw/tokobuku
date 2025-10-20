<?php

namespace App\Filament\Resources\G003M011Sales\Schemas;

use App\Models\G001M004Book;
use App\Models\G003M011Sale;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use App\Filament\Resources\G003M012SaleItems\Schemas\G003M012SaleItemForm;

class G003M011SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('sale_date')
                    ->label('Tanggal Penjualan')
                    ->default(now()),
                Select::make('g002_m007_location_id')
                    ->searchable()
                    ->preload()
                    ->relationship('location', 'name')
                    ->label('Lokasi Penjualan')
                    ->default(auth()->user()->location->id ?? null),
                Select::make('user_id')
                    ->searchable()
                    ->preload()
                    ->relationship('seller', 'name')
                    ->label('Dijual Oleh')
                    ->default(auth()->id() ?? null),
                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->default(null),
                TextInput::make('total')
                    ->numeric()
                    ->hidden()
                    ->label('Total Penjualan')
                    ->default(null),
                Repeater::make('items')
                    ->label('Item Penjualan')
                    ->relationship('items')
                    ->schema([
                        Hidden::make('g003_m011_sale_id')
                            ->default(function (G003M011Sale $record) {
                                return $record->id;
                            }),
                        Select::make('g001_m004_book_id')
                            ->label('Judul Buku')
                            ->searchable()
                            ->preload()
                            ->relationship('book', 'title')
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                // Assuming Book model has a 'price' attribute
                                $book = G001M004Book::find($state);

                                if ($book) {
                                    $book_price = auth()->user()->hasRole('agen') ? $book->agent_price : $book->retail_price;
                                    $set('unit_price', $book_price);
                                    if ($get('qty')) {
                                        $set('subtotal', $get('qty') * $book_price);
                                    }
                                }
                            }),
                        TextInput::make('qty')
                            ->label('Jumlah Pembelian')
                            ->numeric()
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                $unit_price = $get('unit_price') ?? 0;
                                $set('subtotal', $state * $unit_price);
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
                    ]),
            ]);
    }
}
