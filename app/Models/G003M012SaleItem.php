<?php

namespace App\Models;

use App\Observers\G003M012SaleItemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(G003M012SaleItemObserver::class)]
class G003M012SaleItem extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    
    public function sale(): BelongsTo
    {
        return $this->belongsTo(G003M011Sale::class, 'g003_m011_sale_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(G001M004Book::class, 'g001_m004_book_id');
    }
}

