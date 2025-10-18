<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G001M006CategoryBook;
use Illuminate\Auth\Access\HandlesAuthorization;

class G001M006CategoryBookPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G001M006CategoryBook');
    }

    public function view(AuthUser $authUser, G001M006CategoryBook $g001M006CategoryBook): bool
    {
        return $authUser->can('View:G001M006CategoryBook');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G001M006CategoryBook');
    }

    public function update(AuthUser $authUser, G001M006CategoryBook $g001M006CategoryBook): bool
    {
        return $authUser->can('Update:G001M006CategoryBook');
    }

    public function delete(AuthUser $authUser, G001M006CategoryBook $g001M006CategoryBook): bool
    {
        return $authUser->can('Delete:G001M006CategoryBook');
    }

    public function restore(AuthUser $authUser, G001M006CategoryBook $g001M006CategoryBook): bool
    {
        return $authUser->can('Restore:G001M006CategoryBook');
    }

    public function forceDelete(AuthUser $authUser, G001M006CategoryBook $g001M006CategoryBook): bool
    {
        return $authUser->can('ForceDelete:G001M006CategoryBook');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G001M006CategoryBook');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G001M006CategoryBook');
    }

    public function replicate(AuthUser $authUser, G001M006CategoryBook $g001M006CategoryBook): bool
    {
        return $authUser->can('Replicate:G001M006CategoryBook');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G001M006CategoryBook');
    }

}