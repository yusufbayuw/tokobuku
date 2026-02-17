<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TemplatePublisherExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                'name' => 'Penguin Books',
                'email' => 'contact@penguin.com',
                'phone' => '+1-555-0101',
                'address' => '123 Publisher Lane, NY',
                'description' => 'Global giant in publishing.',
            ],
            [
                'name' => 'Self Publisher',
                'email' => 'me@myself.com',
                'phone' => '08123456789',
                'address' => '',
                'description' => '',
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'phone',
            'address',
            'description',
        ];
    }
}
