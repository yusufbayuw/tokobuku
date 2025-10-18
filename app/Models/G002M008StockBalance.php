<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G002M008StockBalance extends Model
{
    public function book(): BelongsTo
    {
        return $this->belongsTo(G001M004Book::class, 'g001_m004_book_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(G002M007Location::class, 'g002_m007_location_id');
    }
}
