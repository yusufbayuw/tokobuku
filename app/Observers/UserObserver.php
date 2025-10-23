<?php

namespace App\Observers;

use App\Models\G002M007Location;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->hasRole('agen')) {
            G002M007Location::firstOrCreate(['user_id' => $user->id], [
                'name' => 'Agen ' . $user->name,
                'type' => 'agen',
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->hasRole('agen')) {
            G002M007Location::firstOrCreate(['user_id' => $user->id], [
                'name' => 'Agen ' . $user->name,
                'type' => 'agen',
            ]);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
