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
        // Handle location creation/update when user becomes an agent or name changes
        if ($user->role_helper == 'agen') {
            $user->syncRoles([]);
            $user->assignRole('agen');
            $user->saveQuietly();
            G002M007Location::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => 'Agen ' . $user->name,
                    'type' => 'agen',
                ]
            );
        }

        if ($user->role_helper == 'admin') {
            $user->syncRoles([]);
            $user->assignRole('admin');
            $user->saveQuietly();
        }

        if ($user->role_helper == 'super_admin') {
            $user->syncRoles([]);
            $user->assignRole('super_admin');
            $user->saveQuietly();
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Handle location creation/update when user becomes an agent or name changes
        if ($user->role_helper == 'agen') {
            $user->syncRoles([]);
            $user->assignRole('agen');
            $user->saveQuietly();
            G002M007Location::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => 'Agen ' . $user->name,
                    'type' => 'agen',
                ]
            );
        }

        if ($user->role_helper == 'admin') {
            $user->syncRoles([]);
            $user->assignRole('admin');
            $user->saveQuietly();
        }

        if ($user->role_helper == 'super_admin') {
            $user->syncRoles([]);
            $user->assignRole('super_admin');
            $user->saveQuietly();
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
