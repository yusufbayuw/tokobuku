<?php

namespace App\Filament\Resources\G002M010ReturnItems;

use App\Filament\Resources\G002M010ReturnItems\Pages\CreateG002M010ReturnItem;
use App\Filament\Resources\G002M010ReturnItems\Pages\EditG002M010ReturnItem;
use App\Filament\Resources\G002M010ReturnItems\Pages\ListG002M010ReturnItems;
use App\Filament\Resources\G002M010ReturnItems\Pages\ViewG002M010ReturnItem;
use App\Filament\Resources\G002M010ReturnItems\Schemas\G002M010ReturnItemForm;
use App\Filament\Resources\G002M010ReturnItems\Schemas\G002M010ReturnItemInfolist;
use App\Filament\Resources\G002M010ReturnItems\Tables\G002M010ReturnItemsTable;
use App\Models\G002M010ReturnItem;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G002M010ReturnItemResource extends Resource
{
    protected static ?string $model = G002M010ReturnItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookmark;
    protected static string|UnitEnum|null $navigationGroup = '📝 Rekap & Laporan';
    protected static ?string $slug = 'return-item';
    protected static ?string $modelLabel = 'Buku Terdistribusi';
    protected static ?string $navigationLabel = 'Buku Terdistribusi';

    public static function form(Schema $schema): Schema
    {
        return G002M010ReturnItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G002M010ReturnItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G002M010ReturnItemsTable::configure($table);
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
            'index' => ListG002M010ReturnItems::route('/'),
            'create-return-item-170845' => CreateG002M010ReturnItem::route('/create'),
            'view' => ViewG002M010ReturnItem::route('/{record}'),
            'edit-return-item-170845' => EditG002M010ReturnItem::route('/{record}/edit'),
        ];
    }
}
