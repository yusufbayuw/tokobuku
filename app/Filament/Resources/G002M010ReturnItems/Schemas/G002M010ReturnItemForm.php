<?php

namespace App\Filament\Resources\G002M010ReturnItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use App\Models\G002M009Return;
use App\Models\G002M008StockBalance;

class G002M010ReturnItemForm
{
    public static function configure(Schema $schema): Schema
    {
        /**
         * Helper to fetch available stock qty for given return and book.
         * Uses value() to fetch single columns and avoids loading full models.
         */
        $getStockQty = function ($returnId, $bookId) {
            if (! $returnId || ! $bookId) {
                return null;
            }

            $fromLocationId = G002M009Return::where('id', $returnId)->value('from_location_id');

            if (! $fromLocationId) {
                return null;
            }

            return G002M008StockBalance::where('g002_m007_location_id', $fromLocationId)
                ->where('g001_m004_book_id', $bookId)
                ->value('qty');
        };

        return $schema
            ->components([
                Select::make('g002_m009_return_id')
                    ->label('Distribusi Buku')
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->relationship('retur', 'id')
                    ->default(null),
                Select::make('g001_m004_book_id')
                    ->label('Buku')
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->relationship('book', 'title'),
                TextInput::make('qty')
                    ->label('Jumlah')
                    ->reactive()
                    ->minValue(1)
                    ->disabled(fn (Get $get) => ! $get('g002_m009_return_id') || ! $get('g001_m004_book_id'))
                    ->maxValue(function (Get $get) use ($getStockQty) {
                        $qty = $getStockQty($get('g002_m009_return_id'), $get('g001_m004_book_id'));

                        return $qty ?? 0;
                    })
                    ->hint(function (Get $get) use ($getStockQty) {
                        $qty = $getStockQty($get('g002_m009_return_id'), $get('g001_m004_book_id'));

                        if ($qty !== null) {
                            return 'Stok tersedia: ' . $qty;
                        }

                        return 'Pilih distribusi dan buku yang sesuai';
                    })
                    ->numeric(),
            ]);
    }
}
