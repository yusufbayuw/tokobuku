<?php

namespace App\Observers;

use App\Models\G003M011Sale;
use App\Models\G002M008StockBalance;

class G003M011SaleObserver
{
    public function updated(G003M011Sale $sale): void
    {
        if ($sale->isDirty('status') && $sale->status === 'cancelled') {
            foreach ($sale->items as $item) {
                // Restore stock
                $stockBalance = G002M008StockBalance::where('g001_m004_book_id', $item->g001_m004_book_id)
                    ->where('g002_m007_location_id', $sale->g002_m007_location_id)
                    ->first();

                if ($stockBalance) {
                    $stockBalance->qty += $item->qty;
                    $stockBalance->save();
                } else {
                    G002M008StockBalance::create([
                        'g001_m004_book_id' => $item->g001_m004_book_id,
                        'g002_m007_location_id' => $sale->g002_m007_location_id,
                        'qty' => $item->qty,
                    ]);
                }
            }
        }
    }
}
