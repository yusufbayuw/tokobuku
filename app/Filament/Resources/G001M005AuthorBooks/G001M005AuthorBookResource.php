<?php

namespace App\Filament\Resources\G001M005AuthorBooks;

use App\Filament\Resources\G001M005AuthorBooks\Pages\CreateG001M005AuthorBook;
use App\Filament\Resources\G001M005AuthorBooks\Pages\EditG001M005AuthorBook;
use App\Filament\Resources\G001M005AuthorBooks\Pages\ListG001M005AuthorBooks;
use App\Filament\Resources\G001M005AuthorBooks\Pages\ViewG001M005AuthorBook;
use App\Filament\Resources\G001M005AuthorBooks\Schemas\G001M005AuthorBookForm;
use App\Filament\Resources\G001M005AuthorBooks\Schemas\G001M005AuthorBookInfolist;
use App\Filament\Resources\G001M005AuthorBooks\Tables\G001M005AuthorBooksTable;
use App\Models\G001M005AuthorBook;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G001M005AuthorBookResource extends Resource
{
    protected static ?string $model = G001M005AuthorBook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;
    protected static string|UnitEnum|null $navigationGroup = '📚 Master Data Buku';
    protected static ?string $slug = 'author-book-link-170845';
    protected static ?string $modelLabel = 'Buku Penulis';
    protected static ?string $navigationLabel = 'Buku Penulis';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return G001M005AuthorBookForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G001M005AuthorBookInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G001M005AuthorBooksTable::configure($table);
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
            'index' => ListG001M005AuthorBooks::route('/'),
            'create' => CreateG001M005AuthorBook::route('/create'),
            'view' => ViewG001M005AuthorBook::route('/{record}'),
            'edit' => EditG001M005AuthorBook::route('/{record}/edit'),
        ];
    }
}
