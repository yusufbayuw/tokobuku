<?php

namespace App\Filament\Resources\G003M011Sales;

use App\Filament\Resources\G003M011Sales\Pages\CreateG003M011Sale;
use App\Filament\Resources\G003M011Sales\Pages\EditG003M011Sale;
use App\Filament\Resources\G003M011Sales\Pages\ListG003M011Sales;
use App\Filament\Resources\G003M011Sales\Pages\ViewG003M011Sale;
use App\Filament\Resources\G003M011Sales\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\G003M011Sales\Schemas\G003M011SaleForm;
use App\Filament\Resources\G003M011Sales\Schemas\G003M011SaleInfolist;
use App\Filament\Resources\G003M011Sales\Tables\G003M011SalesTable;
use App\Models\G003M011Sale;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G003M011SaleResource extends Resource
{
    protected static ?string $model = G003M011Sale::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedReceiptPercent;
    protected static string|UnitEnum|null $navigationGroup = '💰 Penjualan';
    protected static ?int $navigationSort = 3;
    protected static ?string $slug = 'sale';
    protected static ?string $modelLabel = 'Penjualan';
    protected static ?string $navigationLabel = 'Penjualan';

    public static function form(Schema $schema): Schema
    {
        return G003M011SaleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G003M011SaleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G003M011SalesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListG003M011Sales::route('/'),
            'create' => CreateG003M011Sale::route('/create'),
            'view' => ViewG003M011Sale::route('/{record}'),
            'edit' => EditG003M011Sale::route('/{record}/edit'),
        ];
    }
}
