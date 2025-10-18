<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class G001M003Publisher extends Model
{
    public function books(): HasMany
    {
        return $this->hasMany(G001M004Book::class, 'g001_m003_publisher_id');
    }
}
