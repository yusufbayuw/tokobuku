<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class G001M002Category extends Model
{
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(
            G001M004Book::class,
            'g001_m006_category_books',
            'g001_m002_category_id',
            'g001_m004_book_id'
        );
    }
}
