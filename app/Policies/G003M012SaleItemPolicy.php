<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G003M012SaleItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class G003M012SaleItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G003M012SaleItem');
    }

    public function view(AuthUser $authUser, G003M012SaleItem $g003M012SaleItem): bool
    {
        return $authUser->can('View:G003M012SaleItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G003M012SaleItem');
    }

    public function update(AuthUser $authUser, G003M012SaleItem $g003M012SaleItem): bool
    {
        return $authUser->can('Update:G003M012SaleItem');
    }

    public function delete(AuthUser $authUser, G003M012SaleItem $g003M012SaleItem): bool
    {
        return $authUser->can('Delete:G003M012SaleItem');
    }

    public function restore(AuthUser $authUser, G003M012SaleItem $g003M012SaleItem): bool
    {
        return $authUser->can('Restore:G003M012SaleItem');
    }

    public function forceDelete(AuthUser $authUser, G003M012SaleItem $g003M012SaleItem): bool
    {
        return $authUser->can('ForceDelete:G003M012SaleItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G003M012SaleItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G003M012SaleItem');
    }

    public function replicate(AuthUser $authUser, G003M012SaleItem $g003M012SaleItem): bool
    {
        return $authUser->can('Replicate:G003M012SaleItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G003M012SaleItem');
    }

}