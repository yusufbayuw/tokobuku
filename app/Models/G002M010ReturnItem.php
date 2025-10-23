<?php

namespace App\Models;

use App\Observers\G002M010ReturnItemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([G002M010ReturnItemObserver::class])]
class G002M010ReturnItem extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    
    public function retur(): BelongsTo
    {
        return $this->belongsTo(G002M009Return::class, 'g002_m009_return_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(G001M004Book::class, 'g001_m004_book_id');
    }
}