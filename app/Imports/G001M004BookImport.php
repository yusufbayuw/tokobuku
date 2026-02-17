<?php

namespace App\Imports;

use App\Models\G001M004Book;
use App\Models\G001M003Publisher;
use App\Models\G001M001Author;
use App\Models\G001M002Category;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class G001M004BookImport implements OnEachRow, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue
{
    /**
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        $rowData = $row->toArray();

        // 1. Handle Publisher (One-to-Many) - Find or Create
        $publisherId = null;
        if (!empty($rowData['publisher'])) {
            $publisher = G001M003Publisher::firstOrCreate(['name' => $rowData['publisher']]);
            $publisherId = $publisher->id;
        }

        // 2. Create Book
        $book = G001M004Book::create([
            'title' => $rowData['title'],
            'subtitle' => $rowData['subtitle'] ?? null,
            'sku' => $rowData['sku'] ?? null,
            'isbn' => $rowData['isbn'] ?? null,
            'edition' => $rowData['edition'] ?? null,
            'language' => $rowData['language'] ?? null,
            'pages' => $rowData['pages'] ?? null,
            'year' => $rowData['year'] ?? null,
            'g001_m003_publisher_id' => $publisherId,
            'retail_price' => $rowData['retail_price'] ?? 0,
            'agent_price' => $rowData['agent_price'] ?? 0,
            'min_stock' => $rowData['min_stock'] ?? 0,
            'cover_photo' => $rowData['cover_photo'] ?? null,
            'active' => isset($rowData['active']) ? (bool) $rowData['active'] : true,
        ]);

        // 3. Handle Authors (Many-to-Many)
        // Expected format: "Author 1; Author 2"
        if (!empty($rowData['authors'])) {
            $authorNames = explode(';', $rowData['authors']);
            $authorIds = [];
            foreach ($authorNames as $name) {
                $name = trim($name);
                if ($name) {
                    $author = G001M001Author::firstOrCreate(['name' => $name]);
                    $authorIds[] = $author->id;
                }
            }
            $book->authors()->sync($authorIds);
        }

        // 4. Handle Categories (Many-to-Many)
        // Expected format: "Category 1; Category 2"
        if (!empty($rowData['categories'])) {
            $categoryNames = explode(';', $rowData['categories']);
            $categoryIds = [];
            foreach ($categoryNames as $name) {
                $name = trim($name);
                if ($name) {
                    $category = G001M002Category::firstOrCreate(['name' => $name]);
                    $categoryIds[] = $category->id;
                }
            }
            $book->categories()->sync($categoryIds);
        }
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'sku' => 'nullable|unique:g001_m004_books,sku',
            'isbn' => 'nullable|unique:g001_m004_books,isbn',
            'publisher' => 'nullable|string',
            'cover_photo' => 'nullable|string',
            'active' => 'nullable|boolean',
            'authors' => 'nullable|string',
            'categories' => 'nullable|string',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
