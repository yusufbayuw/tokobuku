<?php

namespace App\Observers;

use App\Models\G002M008StockBalance;
use App\Models\G003M012SaleItem;

class G003M012SaleItemObserver
{
    /**
     * Handle the G003M012SaleItem "saving" event.
     */
    public function saving(G003M012SaleItem $g003M012SaleItem): void
    {
        $book = $g003M012SaleItem->book;
        if (!$book)
            return;

        $agentPrice = $book->agent_price ?? 0;

        // If consumer_price is not set, set default
        if ($g003M012SaleItem->consumer_price <= 0) {
            if ($g003M012SaleItem->sale && $g003M012SaleItem->sale->location && $g003M012SaleItem->sale->location->type == "toko") {
                $g003M012SaleItem->consumer_price = $book->retail_price ?? 0;
            } else {
                $g003M012SaleItem->consumer_price = $agentPrice;
            }
        }

        $consumerPrice = $g003M012SaleItem->consumer_price;
        $discountPercentage = $g003M012SaleItem->discount ?? 0;

        // Calculate Unit Price (Effective Selling Price)
        $discountAmount = ($consumerPrice * $discountPercentage) / 100;
        $unitPrice = $consumerPrice - $discountAmount;
        $g003M012SaleItem->unit_price = $unitPrice;

        // Calculate Subtotal
        $subtotal = $unitPrice * $g003M012SaleItem->qty;
        $g003M012SaleItem->subtotal = $subtotal;

        // Calculate Margins
        $marginPerUnit = $unitPrice - $agentPrice;
        $g003M012SaleItem->margin = $marginPerUnit;
        $g003M012SaleItem->subtotal_margin = $marginPerUnit * $g003M012SaleItem->qty;
    }

    /**
     * Handle the G003M012SaleItem "created" event.
     */
    public function created(G003M012SaleItem $g003M012SaleItem): void
    {
        // Update Stock
        $stockBalance = G002M008StockBalance::where('g001_m004_book_id', $g003M012SaleItem->g001_m004_book_id)
            ->where('g002_m007_location_id', $g003M012SaleItem->sale->g002_m007_location_id)
            ->first();

        if ($stockBalance) {
            $stockBalance->qty -= $g003M012SaleItem->qty;
            $stockBalance->save();
        } else {
            // Create negative stock if allowed or handle error? Usually we assume stock exists or allow negative.
            G002M008StockBalance::create([
                'g001_m004_book_id' => $g003M012SaleItem->g001_m004_book_id,
                'g002_m007_location_id' => $g003M012SaleItem->sale->g002_m007_location_id,
                'qty' => -$g003M012SaleItem->qty,
            ]);
        }

        // Update Sale Totals
        $sale = $g003M012SaleItem->sale;
        $sale->total = $sale->items()->sum('subtotal');
        $sale->total_margin = $sale->items()->sum('subtotal_margin');
        $sale->save();
    }

    /**
     * Handle the G003M012SaleItem "updated" event.
     */
    public function updated(G003M012SaleItem $g003M012SaleItem): void
    {
        // Handle Stock Update if Qty changed
        if ($g003M012SaleItem->isDirty('qty')) {
            $originalQty = $g003M012SaleItem->getOriginal('qty');
            $newQty = $g003M012SaleItem->qty;
            $diff = $newQty - $originalQty;

            $stockBalance = G002M008StockBalance::where('g001_m004_book_id', $g003M012SaleItem->g001_m004_book_id)
                ->where('g002_m007_location_id', $g003M012SaleItem->sale->g002_m007_location_id)
                ->first();

            if ($stockBalance) {
                $stockBalance->qty -= $diff;
                $stockBalance->save();
            } else {
                // If stock record missing, create (unlikely for update, but valid)
                G002M008StockBalance::create([
                    'g001_m004_book_id' => $g003M012SaleItem->g001_m004_book_id,
                    'g002_m007_location_id' => $g003M012SaleItem->sale->g002_m007_location_id,
                    'qty' => -$diff,
                ]);
            }
        }

        // Recalculate Sale Totals (Always, in case price/qty changed)
        $sale = $g003M012SaleItem->sale;
        $sale->total = $sale->items()->sum('subtotal');
        $sale->total_margin = $sale->items()->sum('subtotal_margin');
        $sale->save();
    }

    /**
     * Handle the G003M012SaleItem "deleted" event.
     */
    public function deleted(G003M012SaleItem $g003M012SaleItem): void
    {
        // If sale is cancelled, stock was already restored by SaleObserver.
        // Do not restore again.
        if ($g003M012SaleItem->sale && $g003M012SaleItem->sale->status === 'cancelled') {
            // Still need to update sale totals? Yes, if item is removed from a cancelled sale (unlikely but possible).
            // But usually cancelled sale is locked.
            // If we do update totals, loop below is fine.
            // Just skip stock restore.
        } else {
            $qty = $g003M012SaleItem->qty;

            // Restore stock: add back qty to sale location
            $stockBalance = G002M008StockBalance::where('g001_m004_book_id', $g003M012SaleItem->g001_m004_book_id)
                ->where('g002_m007_location_id', $g003M012SaleItem->sale->g002_m007_location_id)
                ->first();
            if ($stockBalance) {
                $stockBalance->qty = ($stockBalance->qty ?? 0) + $qty;
                $stockBalance->save();
            } else {
                G002M008StockBalance::create([
                    'g001_m004_book_id' => $g003M012SaleItem->g001_m004_book_id,
                    'g002_m007_location_id' => $g003M012SaleItem->sale->g002_m007_location_id,
                    'qty' => $qty,
                ]);
            }
        }

        // Recalculate sale total explicitly to be safe
        $sale = $g003M012SaleItem->sale;
        if ($sale) {
            $sale->total = $sale->items()->sum('subtotal');
            $sale->total_margin = $sale->items()->sum('subtotal_margin');
            $sale->save();
        }
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
