<?php

namespace App\Imports;

use App\Models\G001M001Author;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class G001M001AuthorImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue, SkipsOnFailure, SkipsOnError
{
    use SkipsFailures, SkipsErrors;

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
            'email' => $row['email'] ?? null,
            'contact_person' => $row['contact_person'] ?? null,
            'address' => $row['address'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'address' => 'nullable|string',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
