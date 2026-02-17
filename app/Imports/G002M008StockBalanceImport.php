<?php

namespace App\Imports;

use App\Models\G002M008StockBalance;
use App\Models\G001M004Book;
use App\Models\G002M007Location;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class G002M008StockBalanceImport implements OnEachRow, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

    /**
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        $rowData = $row->toArray();

        // 1. Find Book by ID
        $book = null;
        if (!empty($rowData['book_id'])) {
            $book = G001M004Book::find($rowData['book_id']);
        }

        // If no book is found, skip
        if (!$book) {
            return;
        }

        // 2. Find Location by Name
        $location = null;
        if (!empty($rowData['location_name'])) {
            $location = G002M007Location::firstOrCreate(['name' => $rowData['location_name']]);
        }

        // If no location, we can't create stock balance (it requires location_id).
        if (!$location) {
            return;
        }

        // 3. Create Stock Balance ONLY if not exists (Initial Input)
        // Per request: Import is only for initial input. Do NOT overwrite existing data.
        G002M008StockBalance::firstOrCreate(
            [
                'g001_m004_book_id' => $book->id,
                'g002_m007_location_id' => $location->id,
            ],
            [
                'qty' => $rowData['qty'] ?? 0,
            ]
        );
    }

    public function rules(): array
    {
        return [
            'book_id' => 'required',
            'location_name' => 'required',
            'qty' => 'required|numeric|min:0',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
