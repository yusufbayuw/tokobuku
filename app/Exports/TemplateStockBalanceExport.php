<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\G001M004Book;
use App\Models\G002M007Location;

class TemplateStockBalanceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    public function collection()
    {
        return G001M004Book::all();
    }

    public function map($book): array
    {
        return [
            $book->id,
            $book->title,
            '', // location_name placeholder
            0,  // qty placeholder
        ];
    }

    public function headings(): array
    {
        return [
            'book_id',
            'book_title',
            'location_name',
            'qty',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // 1. Get all available locations
                $locations = G002M007Location::pluck('name')->toArray();
                $locationCount = count($locations);

                if ($locationCount > 0) {
                    // 2. Write locations to a hidden column (e.g., Column Z) to avoid formula length limits
                    // Start writing from Z1
                    $sheet = $event->sheet->getDelegate();

                    for ($i = 0; $i < $locationCount; $i++) {
                        $sheet->setCellValue('Z' . ($i + 1), $locations[$i]);
                    }

                    // 3. Define the source range for the list
                    // Z1 until Z(last_location)
                    // Note: Absolute reference $Z$1:$Z$N is safer
                    $sourceRange = '$Z$1:$Z$' . $locationCount;

                    // 4. Calculate rows to apply validation (from row 2 down to max rows)
                    $rowCount = $sheet->getHighestRow();

                    // 5. Apply validation to Column C (Location Name) - C2:C(rowCount)
                    $validationRange = 'C2:C' . $rowCount;
                    $validation = $sheet->getCell('C2')->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input Error');
                    $validation->setError('Value is not in list.');
                    $validation->setPromptTitle('Pick Location');
                    $validation->setPrompt('Please select a location from the list.');
                    $validation->setFormula1($sourceRange);

                    // Apply to likely range of rows
                    // Ideally we iterate, but setting on C2 and copying down conceptually works? 
                    // No, setDataValidation applies to specific cell or range if loop.
                    // Actually, setDataValidation on a range string is not directly supported by getCell()->getDataValidation(), it returns validation for that generic cell.
                    // We need to set it for the range.
    
                    for ($row = 2; $row <= $rowCount; $row++) {
                        $sheet->getCell('C' . $row)->setDataValidation(clone $validation);
                    }

                    // 6. Hide Column Z
                    $sheet->getColumnDimension('Z')->setVisible(false);
                }
            },
        ];
    }
}
