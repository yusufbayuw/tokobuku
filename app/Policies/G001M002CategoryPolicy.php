<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G001M002Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class G001M002CategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G001M002Category');
    }

    public function view(AuthUser $authUser, G001M002Category $g001M002Category): bool
    {
        return $authUser->can('View:G001M002Category');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G001M002Category');
    }

    public function update(AuthUser $authUser, G001M002Category $g001M002Category): bool
    {
        return $authUser->can('Update:G001M002Category');
    }

    public function delete(AuthUser $authUser, G001M002Category $g001M002Category): bool
    {
        return $authUser->can('Delete:G001M002Category');
    }

    public function restore(AuthUser $authUser, G001M002Category $g001M002Category): bool
    {
        return $authUser->can('Restore:G001M002Category');
    }

    public function forceDelete(AuthUser $authUser, G001M002Category $g001M002Category): bool
    {
        return $authUser->can('ForceDelete:G001M002Category');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G001M002Category');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G001M002Category');
    }

    public function replicate(AuthUser $authUser, G001M002Category $g001M002Category): bool
    {
        return $authUser->can('Replicate:G001M002Category');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G001M002Category');
    }

}