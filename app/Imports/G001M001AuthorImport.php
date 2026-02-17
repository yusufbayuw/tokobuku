<?php

namespace App\Imports;

use App\Models\G001M001Author;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class G001M001AuthorImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new G001M001Author([
            'name' => $row['name'],
            'bio' => $row['bio'] ?? null,
            'photo' => $row['photo'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|string',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
