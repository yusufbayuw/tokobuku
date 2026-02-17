<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TemplateAuthorExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                'name' => 'John Doe',
                'bio' => 'A famous writer of mystery novels.',
                'photo' => 'https://example.com/photos/johndoe.jpg',
            ],
            [
                'name' => 'Jane Smith, Ph.D.',
                'bio' => 'Expert in science fiction.',
                'photo' => '',
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'bio',
            'photo',
        ];
    }
}
