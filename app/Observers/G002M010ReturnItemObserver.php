<?php

namespace App\Observers;

use App\Models\G002M008StockBalance;
use App\Models\G002M010ReturnItem;

class G002M010ReturnItemObserver
{
    /**
     * Handle the G002M010ReturnItem "created" event.
     */
    public function created(G002M010ReturnItem $g002M010ReturnItem): void
    {
        $qty = $g002M010ReturnItem->qty;
        
        $stockBalanceFrom = G002M008StockBalance::where('g001_m004_book_id', $g002M010ReturnItem->g001_m004_book_id)
            ->where('g002_m007_location_id', $g002M010ReturnItem->retur->from_location_id)
            ->first();
        if ($stockBalanceFrom) {
            $stockBalanceFrom->qty = ($stockBalanceFrom->qty ?? 0) - $qty;
            $stockBalanceFrom->save();
        }

        $stockBalanceTo = G002M008StockBalance::where('g001_m004_book_id', $g002M010ReturnItem->g001_m004_book_id)
            ->where('g002_m007_location_id', $g002M010ReturnItem->retur->to_location_id)
            ->first();
        if ($stockBalanceTo) {
            $stockBalanceTo->qty = ($stockBalanceTo->qty ?? 0) + $qty;
            $stockBalanceTo->save();
        } else {
            G002M008StockBalance::create([
                'g001_m004_book_id' => $g002M010ReturnItem->g001_m004_book_id,
                'g002_m007_location_id' => $g002M010ReturnItem->retur->to_location_id,
                'qty' => $qty,
            ]);
        }
    }

    /**
     * Handle the G002M010ReturnItem "updated" event.
     */
    public function updated(G002M010ReturnItem $g002M010ReturnItem): void
    {
        //
    }

    /**
     * Handle the G002M010ReturnItem "deleted" event.
     */
    public function deleted(G002M010ReturnItem $g002M010ReturnItem): void
    {
        //
    }

    /**
     * Handle the G002M010ReturnItem "restored" event.
     */
    public function restored(G002M010ReturnItem $g002M010ReturnItem): void
    {
        //
    }

    /**
     * Handle the G002M010ReturnItem "force deleted" event.
     */
    public function forceDeleted(G002M010ReturnItem $g002M010ReturnItem): void
    {
        //
    }
}
