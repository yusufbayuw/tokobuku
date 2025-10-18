<?php

namespace App\Filament\Resources\G001M001Authors;

use App\Filament\Resources\G001M001Authors\Pages\CreateG001M001Author;
use App\Filament\Resources\G001M001Authors\Pages\EditG001M001Author;
use App\Filament\Resources\G001M001Authors\Pages\ListG001M001Authors;
use App\Filament\Resources\G001M001Authors\Pages\ViewG001M001Author;
use App\Filament\Resources\G001M001Authors\Schemas\G001M001AuthorForm;
use App\Filament\Resources\G001M001Authors\Schemas\G001M001AuthorInfolist;
use App\Filament\Resources\G001M001Authors\Tables\G001M001AuthorsTable;
use App\Models\G001M001Author;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class G001M001AuthorResource extends Resource
{
    protected static ?string $model = G001M001Author::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static string|UnitEnum|null $navigationGroup = '📚 Master Data Buku';
    protected static ?string $slug = 'author';
    protected static ?string $modelLabel = 'Daftar Penulis';
    protected static ?string $navigationLabel = 'Daftar Penulis';

    public static function form(Schema $schema): Schema
    {
        return G001M001AuthorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G001M001AuthorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G001M001AuthorsTable::configure($table);
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
            'index' => ListG001M001Authors::route('/'),
            'create' => CreateG001M001Author::route('/create'),
            'view' => ViewG001M001Author::route('/{record}'),
            'edit' => EditG001M001Author::route('/{record}/edit'),
        ];
    }
}
