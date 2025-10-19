<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class G001M001Author extends Model
{
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(
            G001M004Book::class,
            'g001_m005_author_books',
            'g001_m001_author_id',
            'g001_m004_book_id'
        );
    }
}

