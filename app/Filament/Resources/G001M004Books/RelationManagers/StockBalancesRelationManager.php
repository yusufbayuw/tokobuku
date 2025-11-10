<?php

namespace App\Filament\Resources\G001M004Books\RelationManagers;

use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\G002M008StockBalances\G002M008StockBalanceResource;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;

class StockBalancesRelationManager extends RelationManager
{
    protected static string $relationship = 'stocks';

    protected static null|string $inverseRelationship = 'book';
    protected static ?string $recordTitleAttribute = 'Daftar Stok Buku';
    protected static ?string $modelLabel = 'Stok Buku';
    protected static ?string $title = 'Daftar Stok Buku';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('location.name')
                    ->label('Lokasi'),
                TextColumn::make('qty')
                    ->label('Jumlah'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Buat Stok Buku')
                    ->using(function (array $data, $relationManager) {
                        // buat stock buku
                        $stock = \App\Models\G002M008StockBalance::create($data);

                        return $stock;
                    })
                    ->schema([
                        Hidden::make('g001_m004_book_id')
                            ->default($this->getOwnerRecord()->id),
                        Select::make('g002_m007_location_id')
                            ->label('Lokasi Buku')
                            ->searchable()
                            ->preload()
                            ->relationship('location', 'name')
                            ->required(),
                        TextInput::make('qty')
                            ->label('Kuantitas')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                    ]),
            ]);
    }
}
