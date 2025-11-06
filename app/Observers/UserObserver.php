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
        // Role assignment happens after user creation in Filament
        // Location will be created in the updated() event
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Handle location creation/update when user becomes an agent or name changes
        if ($user->hasRole('agen')) {
            G002M007Location::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => 'Agen ' . $user->name,
                    'type' => 'agen',
                ]
            );
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Remove all locations associated with the user when deleted
        G002M007Location::where('user_id', $user->id)->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        // If user is restored and has agent role, recreate their location
        if ($user->hasRole('agen')) {
            G002M007Location::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => 'Agen ' . $user->name,
                    'type' => 'agen',
                ]
            );
        }
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        // Ensure all locations are removed when user is force deleted
        G002M007Location::where('user_id', $user->id)->delete();
    }
}
