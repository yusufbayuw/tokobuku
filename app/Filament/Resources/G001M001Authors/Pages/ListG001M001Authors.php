<?php

namespace App\Filament\Resources\G001M001Authors\Pages;

use App\Filament\Resources\G001M001Authors\G001M001AuthorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG001M001Authors extends ListRecords
{
    protected static string $resource = G001M001AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn() => \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\TemplateAuthorExport, 'template_authors.xlsx')),
            CreateAction::make(),
        ];
    }
}
