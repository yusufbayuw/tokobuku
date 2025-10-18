<?php

namespace App\Filament\Resources\G002M009Returns;

use App\Filament\Resources\G002M009Returns\Pages\CreateG002M009Return;
use App\Filament\Resources\G002M009Returns\Pages\EditG002M009Return;
use App\Filament\Resources\G002M009Returns\Pages\ListG002M009Returns;
use App\Filament\Resources\G002M009Returns\Pages\ViewG002M009Return;
use App\Filament\Resources\G002M009Returns\Schemas\G002M009ReturnForm;
use App\Filament\Resources\G002M009Returns\Schemas\G002M009ReturnInfolist;
use App\Filament\Resources\G002M009Returns\Tables\G002M009ReturnsTable;
use App\Models\G002M009Return;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G002M009ReturnResource extends Resource
{
    protected static ?string $model = G002M009Return::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;
    protected static string|UnitEnum|null $navigationGroup = '🏛️ Inventori & Lokasi';
    protected static ?string $slug = 'return';
    protected static ?string $modelLabel = 'Distribusi Buku';
    protected static ?string $navigationLabel = 'Distribusi Buku';

    public static function form(Schema $schema): Schema
    {
        return G002M009ReturnForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G002M009ReturnInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G002M009ReturnsTable::configure($table);
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
            'index' => ListG002M009Returns::route('/'),
            'create' => CreateG002M009Return::route('/create'),
            'view' => ViewG002M009Return::route('/{record}'),
            'edit' => EditG002M009Return::route('/{record}/edit'),
        ];
    }
}
