<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G003M011Sale extends Model
{
    public function location(): BelongsTo
    {
        return $this->belongsTo(G002M007Location::class, 'g002_m007_location_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(G003M012SaleItem::class, 'g003_m011_sale_id');
    }
}
