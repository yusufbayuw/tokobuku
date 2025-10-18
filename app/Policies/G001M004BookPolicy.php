<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G001M004Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class G001M004BookPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G001M004Book');
    }

    public function view(AuthUser $authUser, G001M004Book $g001M004Book): bool
    {
        return $authUser->can('View:G001M004Book');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G001M004Book');
    }

    public function update(AuthUser $authUser, G001M004Book $g001M004Book): bool
    {
        return $authUser->can('Update:G001M004Book');
    }

    public function delete(AuthUser $authUser, G001M004Book $g001M004Book): bool
    {
        return $authUser->can('Delete:G001M004Book');
    }

    public function restore(AuthUser $authUser, G001M004Book $g001M004Book): bool
    {
        return $authUser->can('Restore:G001M004Book');
    }

    public function forceDelete(AuthUser $authUser, G001M004Book $g001M004Book): bool
    {
        return $authUser->can('ForceDelete:G001M004Book');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G001M004Book');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G001M004Book');
    }

    public function replicate(AuthUser $authUser, G001M004Book $g001M004Book): bool
    {
        return $authUser->can('Replicate:G001M004Book');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G001M004Book');
    }

}