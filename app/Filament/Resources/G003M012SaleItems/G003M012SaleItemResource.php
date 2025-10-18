<?php

namespace App\Filament\Resources\G003M012SaleItems;

use App\Filament\Resources\G003M012SaleItems\Pages\CreateG003M012SaleItem;
use App\Filament\Resources\G003M012SaleItems\Pages\EditG003M012SaleItem;
use App\Filament\Resources\G003M012SaleItems\Pages\ListG003M012SaleItems;
use App\Filament\Resources\G003M012SaleItems\Pages\ViewG003M012SaleItem;
use App\Filament\Resources\G003M012SaleItems\Schemas\G003M012SaleItemForm;
use App\Filament\Resources\G003M012SaleItems\Schemas\G003M012SaleItemInfolist;
use App\Filament\Resources\G003M012SaleItems\Tables\G003M012SaleItemsTable;
use App\Models\G003M012SaleItem;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G003M012SaleItemResource extends Resource
{
    protected static ?string $model = G003M012SaleItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;
    protected static string|UnitEnum|null $navigationGroup = '💰 Transaksi Penjualan';
    protected static ?string $slug = 'sale-item';
    protected static ?string $modelLabel = 'Buku Terjual';
    protected static ?string $navigationLabel = 'Buku Terjual';

    public static function form(Schema $schema): Schema
    {
        return G003M012SaleItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G003M012SaleItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G003M012SaleItemsTable::configure($table);
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
            'index' => ListG003M012SaleItems::route('/'),
            'create' => CreateG003M012SaleItem::route('/create'),
            'view' => ViewG003M012SaleItem::route('/{record}'),
            'edit' => EditG003M012SaleItem::route('/{record}/edit'),
        ];
    }
}
