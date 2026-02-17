<?php

namespace App\Filament\Resources\G001M004Books\Pages;

use App\Filament\Resources\G001M004Books\G001M004BookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG001M004Books extends ListRecords
{
    protected static string $resource = G001M004BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn() => \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\TemplateBookExport, 'template_books.xlsx')),
            CreateAction::make(),
        ];
    }
}
