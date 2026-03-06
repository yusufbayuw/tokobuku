<?php

namespace App\Observers;

use App\Models\G003M011Sale;
use App\Models\G002M008StockBalance;

class G003M011SaleObserver
{
    public function creating(G003M011Sale $sale): void
    {
        $user = auth()->user();
        if ($user && $user->hasRole('agen')) {
            $allowedLocations = $user->locations->pluck('id')->all();
            if (!in_array($sale->g002_m007_location_id, $allowedLocations)) {
                abort(403, 'Anda tidak memiliki akses ke lokasi yang dipilih.');
            }
        }
    }

    public function saving(G003M011Sale $sale): void
    {
        file_put_contents(storage_path('logs/debug_sale.log'), "[" . date('Y-m-d H:i:s') . "] Saving sale. Original status: " . $sale->getOriginal('status') . ", New status: " . $sale->status . "\n", FILE_APPEND);
    }

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
