<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G002M009Return;
use Illuminate\Auth\Access\HandlesAuthorization;

class G002M009ReturnPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G002M009Return');
    }

    public function view(AuthUser $authUser, G002M009Return $g002M009Return): bool
    {
        return $authUser->can('View:G002M009Return');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G002M009Return');
    }

    public function update(AuthUser $authUser, G002M009Return $g002M009Return): bool
    {
        return $authUser->can('Update:G002M009Return');
    }

    public function delete(AuthUser $authUser, G002M009Return $g002M009Return): bool
    {
        return $authUser->can('Delete:G002M009Return');
    }

    public function restore(AuthUser $authUser, G002M009Return $g002M009Return): bool
    {
        return $authUser->can('Restore:G002M009Return');
    }

    public function forceDelete(AuthUser $authUser, G002M009Return $g002M009Return): bool
    {
        return $authUser->can('ForceDelete:G002M009Return');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G002M009Return');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G002M009Return');
    }

    public function replicate(AuthUser $authUser, G002M009Return $g002M009Return): bool
    {
        return $authUser->can('Replicate:G002M009Return');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G002M009Return');
    }

}