<?php

namespace App\Filament\Resources\G002M007Locations\RelationManagers;

use App\Filament\Resources\G002M008StockBalances\G002M008StockBalanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class StockBalancesRelationManager extends RelationManager
{
    protected static string $relationship = 'stocks';

    protected static null|string $inverseRelationship = 'location';
    protected static ?string $recordTitleAttribute = 'Daftar Stok Buku';
    protected static ?string $modelLabel = 'Stok Buku';
    protected static ?string $title = 'Daftar Stok Buku';

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
