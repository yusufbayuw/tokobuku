<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G002M007Location;
use Illuminate\Auth\Access\HandlesAuthorization;

class G002M007LocationPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G002M007Location');
    }

    public function view(AuthUser $authUser, G002M007Location $g002M007Location): bool
    {
        return $authUser->can('View:G002M007Location');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G002M007Location');
    }

    public function update(AuthUser $authUser, G002M007Location $g002M007Location): bool
    {
        return $authUser->can('Update:G002M007Location');
    }

    public function delete(AuthUser $authUser, G002M007Location $g002M007Location): bool
    {
        return $authUser->can('Delete:G002M007Location');
    }

    public function restore(AuthUser $authUser, G002M007Location $g002M007Location): bool
    {
        return $authUser->can('Restore:G002M007Location');
    }

    public function forceDelete(AuthUser $authUser, G002M007Location $g002M007Location): bool
    {
        return $authUser->can('ForceDelete:G002M007Location');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G002M007Location');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G002M007Location');
    }

    public function replicate(AuthUser $authUser, G002M007Location $g002M007Location): bool
    {
        return $authUser->can('Replicate:G002M007Location');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G002M007Location');
    }

}