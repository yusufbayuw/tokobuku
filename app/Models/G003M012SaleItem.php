<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G003M012SaleItem extends Model
{
    public function sale(): BelongsTo
    {
        return $this->belongsTo(G003M011Sale::class, 'g003_m011_sale_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(G001M004Book::class, 'g001_m004_book_id');
    }
}

