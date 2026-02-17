<?php

namespace App\Imports;

use App\Models\G001M002Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class G001M002CategoryImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new G001M002Category([
            'name' => $row['name'],
            'description' => $row['description'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:g001_m002_categories,name',
            'description' => 'nullable',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
