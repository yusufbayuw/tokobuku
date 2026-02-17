<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TemplateCategoryExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                'name' => 'Science Fiction',
                'description' => 'Books about futuristic concepts.',
            ],
            [
                'name' => 'Romance',
                'description' => '',
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'description',
        ];
    }
}
