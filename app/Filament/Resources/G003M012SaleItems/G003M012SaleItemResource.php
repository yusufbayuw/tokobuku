<?php

namespace App\Filament\Resources\G003M012SaleItems;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\G003M012SaleItem;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\G003M012SaleItems\Pages\EditG003M012SaleItem;
use App\Filament\Resources\G003M012SaleItems\Pages\ViewG003M012SaleItem;
use App\Filament\Resources\G003M012SaleItems\Pages\ListG003M012SaleItems;
use App\Filament\Resources\G003M012SaleItems\Pages\CreateG003M012SaleItem;
use App\Filament\Resources\G003M012SaleItems\Schemas\G003M012SaleItemForm;
use App\Filament\Resources\G003M012SaleItems\Tables\G003M012SaleItemsTable;
use App\Filament\Resources\G003M012SaleItems\Schemas\G003M012SaleItemInfolist;

class G003M012SaleItemResource extends Resource
{
    protected static ?string $model = G003M012SaleItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;
    protected static string|UnitEnum|null $navigationGroup = '📝 Rekap Transaksi';
    protected static ?int $navigationSort = 4;
    protected static ?string $slug = 'sale-item';
    protected static ?string $modelLabel = 'Buku Terjual';
    protected static ?string $navigationLabel = 'Buku Terjual';

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole(['admin', 'super_admin'])) {
            return parent::getEloquentQuery();
        } elseif (auth()->user()->hasRole('agen')) {
            $saleIds = auth()->user()->sales->pluck('id')->all();

            if (empty($saleIds)) {
                // user has no locations -> return empty query
                return parent::getEloquentQuery()->whereRaw('0 = 1');
            }

            return parent::getEloquentQuery()->whereIn('g003_m011_sale_id', $saleIds);
        } else {
            $saleIds = auth()->user()->sales->pluck('id')->all();

            if (empty($saleIds)) {
                return parent::getEloquentQuery()->whereRaw('0 = 1');
            }

            return parent::getEloquentQuery()->whereIn('g003_m011_sale_id', $saleIds);
        }
    }

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
            'create-sale-item-170845' => CreateG003M012SaleItem::route('/create'),
            'view' => ViewG003M012SaleItem::route('/{record}'),
            'edit-sale-item-170845' => EditG003M012SaleItem::route('/{record}/edit'),
        ];
    }
}
