<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TemplateBookExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        return [
            // Scenario 1: Complete book with Publisher, multiple Authors (;), multiple Categories (;)
            [
                'title' => 'The Grand Adventure',
                'subtitle' => 'Part 1: The Beginning',
                'sku' => 'ADV-001',
                'isbn' => '978-3-16-148410-0',
                'edition' => '1st Edition',
                'language' => 'English',
                'pages' => 350,
                'year' => 2024,
                'publisher' => 'Penguin Books',
                'retail_price' => 150000,
                'agent_price' => 120000,
                'min_stock' => 10,
                'cover_photo' => 'https://example.com/covers/adventure.jpg',
                'active' => 1,
                'authors' => 'John Doe; Jane Smith, Ph.D.',
                'categories' => 'Fiction; Adventure',
            ],
            // Scenario 2: Simple book without optional fields
            [
                'title' => 'Simple Cooking',
                'subtitle' => '',
                'sku' => 'CKG-102',
                'isbn' => '',
                'edition' => '',
                'language' => 'Indonesian',
                'pages' => 120,
                'year' => 2023,
                'publisher' => 'Gramedia',
                'retail_price' => 95000,
                'agent_price' => 75000,
                'min_stock' => 5,
                'cover_photo' => '',
                'active' => 1,
                'authors' => 'Chef Arnold',
                'categories' => 'Cooking',
            ],
            // Scenario 3: Book with single author/category
            [
                'title' => 'Learning PHP',
                'subtitle' => 'For Beginners',
                'sku' => 'TECH-PHP-01',
                'isbn' => '978-1-234-56789-0',
                'edition' => '2nd',
                'language' => 'English',
                'pages' => 200,
                'year' => 2022,
                'publisher' => 'Tech Press',
                'retail_price' => 200000,
                'agent_price' => 160000,
                'min_stock' => 20,
                'cover_photo' => '',
                'active' => 0,
                'authors' => 'Taylor Otwell',
                'categories' => 'Technology',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'title',
            'subtitle',
            'sku',
            'isbn',
            'edition',
            'language',
            'pages',
            'year',
            'publisher',
            'retail_price',
            'agent_price',
            'min_stock',
            'cover_photo',
            'active',
            'authors',
            'categories',
        ];
    }
}
