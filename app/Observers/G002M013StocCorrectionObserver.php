<?php

namespace App\Observers;

use App\Models\G002M013StockCorrection;

class G002M013StocCorrectionObserver
{
    /**
     * Handle the G002M013StockCorrection "created" event.
     */
    public function created(G002M013StockCorrection $g002M013StockCorrection): void
    {
        $stockBalance = $g002M013StockCorrection->stockBalance;

        if ($stockBalance) {
            $stockBalance->qty = $stockBalance->qty ?? 0;
            $change = $g002M013StockCorrection->substraction ? -$g002M013StockCorrection->qty : $g002M013StockCorrection->qty;
            $stockBalance->increment('qty', $change);
        }
    }

    public function updated(G002M013StockCorrection $g002M013StockCorrection): void
    {
        $oldBalanceId = $g002M013StockCorrection->getOriginal('g002_m008_stock_balance_id');
        $newBalanceId = $g002M013StockCorrection->g002_m008_stock_balance_id;

        $oldQty = $g002M013StockCorrection->getOriginal('qty');
        $oldSubstraction = $g002M013StockCorrection->getOriginal('substraction');
        $oldChange = $oldSubstraction ? -$oldQty : $oldQty;

        $newQty = $g002M013StockCorrection->qty;
        $newSubstraction = $g002M013StockCorrection->substraction;
        $newChange = $newSubstraction ? -$newQty : $newQty;

        if ($oldBalanceId === $newBalanceId) {
            $stockBalance = $g002M013StockCorrection->stockBalance;
            if ($stockBalance) {
                $stockBalance->qty = $stockBalance->qty ?? 0;
                $diff = $newChange - $oldChange;
                $stockBalance->increment('qty', $diff);
            }
        } else {
            if ($oldBalanceId) {
                $oldBalance = \App\Models\G002M008StockBalance::find($oldBalanceId);
                if ($oldBalance) {
                    $oldBalance->decrement('qty', $oldChange);
                }
            }

            if ($newBalanceId) {
                $newBalance = $g002M013StockCorrection->stockBalance;
                if ($newBalance) {
                    $newBalance->qty = $newBalance->qty ?? 0;
                    $newBalance->increment('qty', $newChange);
                }
            }
        }
    }

    /**
     * Handle the G002M013StockCorrection "deleted" event.
     */
    public function deleted(G002M013StockCorrection $g002M013StockCorrection): void
    {
        $stockBalance = $g002M013StockCorrection->stockBalance;

        if ($stockBalance) {
            $change = $g002M013StockCorrection->substraction ? -$g002M013StockCorrection->qty : $g002M013StockCorrection->qty;
            // Subtract the change to reverse it
            $stockBalance->decrement('qty', $change);
        }
    }

    /**
     * Handle the G002M013StockCorrection "restored" event.
     */
    public function restored(G002M013StockCorrection $g002M013StockCorrection): void
    {
        $stockBalance = $g002M013StockCorrection->stockBalance;

        if ($stockBalance) {
            $stockBalance->qty = $stockBalance->qty ?? 0;
            $change = $g002M013StockCorrection->substraction ? -$g002M013StockCorrection->qty : $g002M013StockCorrection->qty;
            $stockBalance->increment('qty', $change);
        }
    }

    /**
     * Handle the G002M013StockCorrection "force deleted" event.
     */
    public function forceDeleted(G002M013StockCorrection $g002M013StockCorrection): void
    {
        //
    }
}
