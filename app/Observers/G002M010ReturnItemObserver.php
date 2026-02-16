<?php

namespace App\Observers;

use App\Models\G002M010ReturnItem;

class G002M010ReturnItemObserver
{
    /**
     * Handle the G002M010ReturnItem "created" event.
     */
    public function created(G002M010ReturnItem $item): void
    {
        $this->adjustStock($item, $item->qty);
    }

    /**
     * Handle the G002M010ReturnItem "updated" event.
     */
    public function updated(G002M010ReturnItem $item): void
    {
        // Revert old changes (using original qty)
        $oldQty = $item->getOriginal('qty');
        $this->adjustStock($item, -$oldQty);

        // Apply new changes
        $this->adjustStock($item, $item->qty);
    }

    /**
     * Handle the G002M010ReturnItem "deleted" event.
     */
    public function deleted(G002M010ReturnItem $item): void
    {
        // Revert changes (negative of the current qty)
        $this->adjustStock($item, -$item->qty);
    }

    /**
     * Handle the G002M010ReturnItem "restored" event.
     */
    public function restored(G002M010ReturnItem $item): void
    {
        $this->adjustStock($item, $item->qty);
    }

    /**
     * Handle the G002M010ReturnItem "force deleted" event.
     */
    public function forceDeleted(G002M010ReturnItem $item): void
    {
        //
    }

    protected function adjustStock(G002M010ReturnItem $item, int $change): void
    {
        if ($change === 0)
            return;

        // 1. Kurangi stok di lokasi ASAL (Source) -> logic normal: berkurang (-$change)
        $fromLocationId = $item->retur->from_location_id ?? null;
        if ($fromLocationId) {
            $fromBalance = \App\Models\G002M008StockBalance::firstOrCreate([
                'g001_m004_book_id' => $item->g001_m004_book_id,
                'g002_m007_location_id' => $fromLocationId,
            ]);
            $fromBalance->qty = ($fromBalance->qty ?? 0) - $change;
            $fromBalance->save();
        }

        // 2. Tambah stok di lokasi TUJUAN (Destination) -> logic normal: bertambah (+$change)
        $toLocationId = $item->retur->to_location_id ?? null;
        if ($toLocationId) {
            $toBalance = \App\Models\G002M008StockBalance::firstOrCreate([
                'g001_m004_book_id' => $item->g001_m004_book_id,
                'g002_m007_location_id' => $toLocationId,
            ]);
            $toBalance->qty = ($toBalance->qty ?? 0) + $change;
            $toBalance->save();
        }
    }
}
