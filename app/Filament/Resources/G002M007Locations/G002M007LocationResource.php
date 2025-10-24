<?php

namespace App\Filament\Resources\G002M007Locations;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\G002M007Location;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\G002M007Locations\Pages\EditG002M007Location;
use App\Filament\Resources\G002M007Locations\Pages\ViewG002M007Location;
use App\Filament\Resources\G002M007Locations\Pages\ListG002M007Locations;
use App\Filament\Resources\G002M007Locations\Pages\CreateG002M007Location;
use App\Filament\Resources\G002M007Locations\Schemas\G002M007LocationForm;
use App\Filament\Resources\G002M007Locations\Tables\G002M007LocationsTable;
use App\Filament\Resources\G002M007Locations\Schemas\G002M007LocationInfolist;

class G002M007LocationResource extends Resource
{
    protected static ?string $model = G002M007Location::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;
    protected static string|UnitEnum|null $navigationGroup = '🏛️ Inventori & Lokasi';
    protected static ?string $slug = 'location';
    protected static ?string $modelLabel = 'Lokasi';
    protected static ?string $navigationLabel = 'Lokasi';

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole(['admin', 'super_admin']) {
            return parent::getEloquentQuery();
        } elseif (auth()->user()->hasRole('agen') {
            return parent::getEloquentQuery()->where('user_id', auth()->user()->id);
        }
    }

    public static function form(Schema $schema): Schema
    {
        return G002M007LocationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G002M007LocationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G002M007LocationsTable::configure($table);
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
            'index' => ListG002M007Locations::route('/'),
            'create' => CreateG002M007Location::route('/create'),
            'view' => ViewG002M007Location::route('/{record}'),
            'edit' => EditG002M007Location::route('/{record}/edit'),
        ];
    }
}
