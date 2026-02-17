<?php

namespace App\Imports;

use App\Models\G001M003Publisher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class G001M003PublisherImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new G001M003Publisher([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'address' => $row['address'] ?? null,
            'description' => $row['description'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'nullable|email|unique:g001_m003_publishers,email',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
