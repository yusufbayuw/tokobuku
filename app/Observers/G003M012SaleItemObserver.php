<?php

namespace App\Observers;

use App\Models\G002M008StockBalance;
use App\Models\G003M012SaleItem;

class G003M012SaleItemObserver
{
    /**
     * Handle the G003M012SaleItem "created" event.
     */
    public function created(G003M012SaleItem $g003M012SaleItem): void
    {
        if ($g003M012SaleItem->sale->location->type == "toko") {
            $bookPrice = $g003M012SaleItem->book->retail_price;
        } else {
            $bookPrice = $g003M012SaleItem->book->agent_price;
        }

        $g003M012SaleItem->unit_price = $bookPrice;
        $g003M012SaleItem->subtotal = $g003M012SaleItem->qty * $bookPrice;
        $g003M012SaleItem->saveQuietly();

        $stockBalance = G002M008StockBalance::where('g001_m004_book_id', $g003M012SaleItem->g001_m004_book_id)
            ->where('g002_m007_location_id', $g003M012SaleItem->sale->g002_m007_location_id)
            ->first();
        $stockBalance->qty -= $g003M012SaleItem->qty;
        $stockBalance->save();

        $sale = $g003M012SaleItem->sale;
        $sale->total = $sale->items_sum_subtotal;
        $sale->save();
        
    }

    /**
     * Handle the G003M012SaleItem "updated" event.
     */
    public function updated(G003M012SaleItem $g003M012SaleItem): void
    {
        //
    }

    /**
     * Handle the G003M012SaleItem "deleted" event.
     */
    public function deleted(G003M012SaleItem $g003M012SaleItem): void
    {
        //
    }

    /**
     * Handle the G003M012SaleItem "restored" event.
     */
    public function restored(G003M012SaleItem $g003M012SaleItem): void
    {
        //
    }

    /**
     * Handle the G003M012SaleItem "force deleted" event.
     */
    public function forceDeleted(G003M012SaleItem $g003M012SaleItem): void
    {
        //
    }
}
