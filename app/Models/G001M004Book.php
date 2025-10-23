<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class G001M004Book extends Model
{
    public function getRecordTitleAttribute(): string
    {
        return $this->title;
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(
            G001M001Author::class,
            'g001_m005_author_books',
            'g001_m004_book_id',
            'g001_m001_author_id'
        ); // ->withPivot([...])->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            G001M002Category::class,
            'g001_m006_category_books',
            'g001_m004_book_id',
            'g001_m002_category_id'
        );
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(G001M003Publisher::class, 'g001_m003_publisher_id');
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(G003M012SaleItem::class, 'g001_m004_book_id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(G002M008StockBalance::class, 'g001_m004_book_id');
    }
}
