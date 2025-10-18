<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G001M001Author;
use Illuminate\Auth\Access\HandlesAuthorization;

class G001M001AuthorPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G001M001Author');
    }

    public function view(AuthUser $authUser, G001M001Author $g001M001Author): bool
    {
        return $authUser->can('View:G001M001Author');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G001M001Author');
    }

    public function update(AuthUser $authUser, G001M001Author $g001M001Author): bool
    {
        return $authUser->can('Update:G001M001Author');
    }

    public function delete(AuthUser $authUser, G001M001Author $g001M001Author): bool
    {
        return $authUser->can('Delete:G001M001Author');
    }

    public function restore(AuthUser $authUser, G001M001Author $g001M001Author): bool
    {
        return $authUser->can('Restore:G001M001Author');
    }

    public function forceDelete(AuthUser $authUser, G001M001Author $g001M001Author): bool
    {
        return $authUser->can('ForceDelete:G001M001Author');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G001M001Author');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G001M001Author');
    }

    public function replicate(AuthUser $authUser, G001M001Author $g001M001Author): bool
    {
        return $authUser->can('Replicate:G001M001Author');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G001M001Author');
    }

}