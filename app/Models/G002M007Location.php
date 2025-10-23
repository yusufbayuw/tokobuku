<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G002M007Location extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }

    public function sales(): HasMany
    {
        return $this->hasMany(G003M011Sale::class, 'g002_m007_location_id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(G002M008StockBalance::class, 'g002_m007_location_id');
    }

    public function returnsFrom(): HasMany
    {
        return $this->hasMany(G002M009Return::class, 'from_location_id');
    }

    public function returnsTo(): HasMany
    {
        return $this->hasMany(G002M009Return::class, 'to_location_id');
    }
}
