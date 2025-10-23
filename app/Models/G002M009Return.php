<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class G002M009Return extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    
    public function fromLocation(): BelongsTo
    {
        return $this->belongsTo(G002M007Location::class, 'from_location_id');
    }

    public function toLocation(): BelongsTo
    {
        return $this->belongsTo(G002M007Location::class, 'to_location_id');
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(G002M010ReturnItem::class, 'g002_m009_return_id');
    }

    /** Konfirmasi retur → update stok agen (kurang) & toko (tambah) */
    public function confirm(): void
    {
        if ($this->status === 'confirmed') return;

        DB::transaction(function () {
            foreach ($this->items as $item) {
                // Kurangi stok di lokasi asal (agen)
                $from = G002M008StockBalance::firstOrCreate([
                    'book_id' => $item->book_id,
                    'location_id' => $this->from_location_id,
                ]);
                $from->decrement('qty', (int) $item->qty);

                // Tambah stok di lokasi tujuan (toko)
                $to = G002M008StockBalance::firstOrCreate([
                    'book_id' => $item->book_id,
                    'location_id' => $this->to_location_id,
                ]);
                $to->increment('qty', (int) $item->qty);
            }

            $this->update(['status' => 'confirmed']);
        });
    }
}
