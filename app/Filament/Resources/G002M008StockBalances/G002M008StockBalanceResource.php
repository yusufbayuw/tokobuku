<?php

namespace App\Filament\Resources\G002M008StockBalances;

use App\Filament\Resources\G002M008StockBalances\Pages\CreateG002M008StockBalance;
use App\Filament\Resources\G002M008StockBalances\Pages\EditG002M008StockBalance;
use App\Filament\Resources\G002M008StockBalances\Pages\ListG002M008StockBalances;
use App\Filament\Resources\G002M008StockBalances\Pages\ViewG002M008StockBalance;
use App\Filament\Resources\G002M008StockBalances\Schemas\G002M008StockBalanceForm;
use App\Filament\Resources\G002M008StockBalances\Schemas\G002M008StockBalanceInfolist;
use App\Filament\Resources\G002M008StockBalances\Tables\G002M008StockBalancesTable;
use App\Models\G002M008StockBalance;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G002M008StockBalanceResource extends Resource
{
    protected static ?string $model = G002M008StockBalance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCube;
    protected static string|UnitEnum|null $navigationGroup = '🏛️ Inventori & Lokasi';
    protected static ?string $slug = 'stock-balance';
    protected static ?string $modelLabel = 'Jumlah Stok Buku';
    protected static ?string $navigationLabel = 'Jumlah Stok Buku';

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole(['admin', 'super_admin']) {
            return parent::getEloquentQuery();
        } elseif (auth()->user()->hasRole('agen') {
            return parent::getEloquentQuery()->where('g002_m007_location_id', auth()->user()->locations->id);
        }
    }

    public static function form(Schema $schema): Schema
    {
        return G002M008StockBalanceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G002M008StockBalanceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G002M008StockBalancesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListG002M008StockBalances::route('/'),
            'create' => CreateG002M008StockBalance::route('/create'),
            'view' => ViewG002M008StockBalance::route('/{record}'),
            'edit' => EditG002M008StockBalance::route('/{record}/edit'),
        ];
    }
}
