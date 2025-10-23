<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Setiap user (agen) bisa memiliki satu atau lebih lokasi (agen / toko)
     */
    public function locations(): HasMany
    {
        return $this->hasMany(G002M007Location::class, 'user_id');
    }

    /**
     * Semua penjualan yang dilakukan user ini
     */
    public function sales(): HasMany
    {
        return $this->hasMany(G003M011Sale::class, 'sold_by');
    }

    /**
     * Semua retur yang ditangani user ini
     */
    public function handledReturns(): HasMany
    {
        return $this->hasMany(G002M009Return::class, 'handled_by');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
