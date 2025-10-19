<?php

namespace App\Filament\Resources\G001M003Publishers;

use App\Filament\Resources\G001M003Publishers\Pages\CreateG001M003Publisher;
use App\Filament\Resources\G001M003Publishers\Pages\EditG001M003Publisher;
use App\Filament\Resources\G001M003Publishers\Pages\ListG001M003Publishers;
use App\Filament\Resources\G001M003Publishers\Pages\ViewG001M003Publisher;
use App\Filament\Resources\G001M003Publishers\RelationManagers\BooksRelationManager;
use App\Filament\Resources\G001M003Publishers\Schemas\G001M003PublisherForm;
use App\Filament\Resources\G001M003Publishers\Schemas\G001M003PublisherInfolist;
use App\Filament\Resources\G001M003Publishers\Tables\G001M003PublishersTable;
use App\Models\G001M003Publisher;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G001M003PublisherResource extends Resource
{
    protected static ?string $model = G001M003Publisher::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;
    protected static string|UnitEnum|null $navigationGroup = '📚 Master Data Buku';
    protected static ?string $slug = 'publisher';
    protected static ?string $modelLabel = 'Penerbit';
    protected static ?string $navigationLabel = 'Penerbit';

    public static function form(Schema $schema): Schema
    {
        return G001M003PublisherForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G001M003PublisherInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G001M003PublishersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            BooksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListG001M003Publishers::route('/'),
            'create' => CreateG001M003Publisher::route('/create'),
            'view' => ViewG001M003Publisher::route('/{record}'),
            'edit' => EditG001M003Publisher::route('/{record}/edit'),
        ];
    }
}
