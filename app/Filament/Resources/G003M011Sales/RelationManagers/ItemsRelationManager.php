<?php

namespace App\Filament\Resources\G003M011Sales\RelationManagers;

use App\Filament\Resources\G003M012SaleItems\G003M012SaleItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $relatedResource = G003M012SaleItemResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
