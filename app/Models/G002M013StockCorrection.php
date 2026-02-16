<?php

namespace App\Models;

use App\Observers\G002M013StocCorrectionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([G002M013StocCorrectionObserver::class])]
class G002M013StockCorrection extends Model
{
    public function stockBalance(): BelongsTo
    {
        return $this->belongsTo(G002M008StockBalance::class, 'g002_m008_stock_balance_id');
    }
}
