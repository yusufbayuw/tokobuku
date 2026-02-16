<?php

namespace App\Filament\Resources\G002M008StockBalances\RelationManagers;

use App\Filament\Resources\G002M013StockCorrections\G002M013StockCorrectionResource;
use App\Filament\Resources\G002M013StockCorrections\Schemas\G002M013StockCorrectionForm;
use App\Filament\Resources\G002M013StockCorrections\Tables\G002M013StockCorrectionsTable;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CorrectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'corrections';

    protected static ?string $inverseRelationship = 'stockBalance';

    protected static ?string $relatedResource = G002M013StockCorrectionResource::class;

    public function table(Table $table): Table
    {
        return G002M013StockCorrectionsTable::configure($table)
            ->headerActions([
                CreateAction::make()
                    ->after(fn($livewire) => $livewire->dispatch('refresh')),
            ]);
    }
}
