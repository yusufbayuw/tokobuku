<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G002M013StockCorrection extends Model
{
    public function stockBalance(): BelongsTo
    {
        return $this->belongsTo(G002M008StockBalance::class, 'g002_m008_stock_balance_id');
    }
}
