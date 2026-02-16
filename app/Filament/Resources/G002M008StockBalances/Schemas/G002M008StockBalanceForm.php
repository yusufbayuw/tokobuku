<?php

namespace App\Filament\Resources\G002M008StockBalances\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Database\Eloquent\Builder;

class G002M008StockBalanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('g001_m004_book_id')
                    ->label('Judul Buku')
                    ->searchable()
                    ->preload()
                    ->relationship('book', 'title')
                    ->required()
                    ->disabledOn('edit')
                    ->reactive()
                    ->afterStateUpdated(fn(Set $set) => $set('g002_m007_location_id', null)),
                Select::make('g002_m007_location_id')
                    ->label('Lokasi Buku')
                    ->searchable()
                    ->disabledOn('edit')
                    ->preload()
                    ->relationship(
                        name: 'location',
                        titleAttribute: 'name',
                        modifyQueryUsing: function (Builder $query, $get, $record) {
                            $bookId = $get('g001_m004_book_id');

                            if (!$bookId) {
                                return $query->whereRaw('1 = 0');
                            }

                            return $query->whereNotIn('id', function ($query) use ($bookId, $record) {
                                $query->select('g002_m007_location_id')
                                    ->from('g002_m008_stock_balances')
                                    ->where('g001_m004_book_id', $bookId)
                                    ->when($record, fn($q) => $q->where('id', '!=', $record->id));
                            });
                        }
                    )
                    ->required(),
                TextInput::make('qty')
                    ->label('Kuantitas')
                    ->numeric()
                    ->live()
                    ->readOnlyOn('edit')
                    ->minValue(1)
                    ->default(null),
            ]);
    }
}
