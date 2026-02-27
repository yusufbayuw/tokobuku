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
                'email' => 'email@example.com',
                'contact_person' => '08123456789',
                'address' => 'Jl. Contoh No. 123',
            ],
            [
                'name' => 'Jane Smith, Ph.D.',
                'bio' => 'Expert in science fiction.',
                'email'=> 'email@example.com',
                'contact_person' => '08123456789',
                'address' => 'Jl. Contoh No. 123',
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'bio',
            'email',
            'contact_person',
            'address',
        ];
    }
}
