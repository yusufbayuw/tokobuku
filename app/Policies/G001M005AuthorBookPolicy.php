<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G001M005AuthorBook;
use Illuminate\Auth\Access\HandlesAuthorization;

class G001M005AuthorBookPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G001M005AuthorBook');
    }

    public function view(AuthUser $authUser, G001M005AuthorBook $g001M005AuthorBook): bool
    {
        return $authUser->can('View:G001M005AuthorBook');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G001M005AuthorBook');
    }

    public function update(AuthUser $authUser, G001M005AuthorBook $g001M005AuthorBook): bool
    {
        return $authUser->can('Update:G001M005AuthorBook');
    }

    public function delete(AuthUser $authUser, G001M005AuthorBook $g001M005AuthorBook): bool
    {
        return $authUser->can('Delete:G001M005AuthorBook');
    }

    public function restore(AuthUser $authUser, G001M005AuthorBook $g001M005AuthorBook): bool
    {
        return $authUser->can('Restore:G001M005AuthorBook');
    }

    public function forceDelete(AuthUser $authUser, G001M005AuthorBook $g001M005AuthorBook): bool
    {
        return $authUser->can('ForceDelete:G001M005AuthorBook');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G001M005AuthorBook');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G001M005AuthorBook');
    }

    public function replicate(AuthUser $authUser, G001M005AuthorBook $g001M005AuthorBook): bool
    {
        return $authUser->can('Replicate:G001M005AuthorBook');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G001M005AuthorBook');
    }

}