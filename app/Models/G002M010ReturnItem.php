<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G002M010ReturnItem extends Model
{
    public function retur(): BelongsTo
    {
        return $this->belongsTo(G002M009Return::class, 'g002_m009_return_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(G001M004Book::class, 'g001_m004_book_id');
    }
}