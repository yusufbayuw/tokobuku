<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G002M010ReturnItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class G002M010ReturnItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G002M010ReturnItem');
    }

    public function view(AuthUser $authUser, G002M010ReturnItem $g002M010ReturnItem): bool
    {
        return $authUser->can('View:G002M010ReturnItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G002M010ReturnItem');
    }

    public function update(AuthUser $authUser, G002M010ReturnItem $g002M010ReturnItem): bool
    {
        return $authUser->can('Update:G002M010ReturnItem');
    }

    public function delete(AuthUser $authUser, G002M010ReturnItem $g002M010ReturnItem): bool
    {
        return $authUser->can('Delete:G002M010ReturnItem');
    }

    public function restore(AuthUser $authUser, G002M010ReturnItem $g002M010ReturnItem): bool
    {
        return $authUser->can('Restore:G002M010ReturnItem');
    }

    public function forceDelete(AuthUser $authUser, G002M010ReturnItem $g002M010ReturnItem): bool
    {
        return $authUser->can('ForceDelete:G002M010ReturnItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G002M010ReturnItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G002M010ReturnItem');
    }

    public function replicate(AuthUser $authUser, G002M010ReturnItem $g002M010ReturnItem): bool
    {
        return $authUser->can('Replicate:G002M010ReturnItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G002M010ReturnItem');
    }

}