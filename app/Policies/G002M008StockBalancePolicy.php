<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G002M008StockBalance;
use Illuminate\Auth\Access\HandlesAuthorization;

class G002M008StockBalancePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G002M008StockBalance');
    }

    public function view(AuthUser $authUser, G002M008StockBalance $g002M008StockBalance): bool
    {
        return $authUser->can('View:G002M008StockBalance');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G002M008StockBalance');
    }

    public function update(AuthUser $authUser, G002M008StockBalance $g002M008StockBalance): bool
    {
        return $authUser->can('Update:G002M008StockBalance');
    }

    public function delete(AuthUser $authUser, G002M008StockBalance $g002M008StockBalance): bool
    {
        return $authUser->can('Delete:G002M008StockBalance');
    }

    public function restore(AuthUser $authUser, G002M008StockBalance $g002M008StockBalance): bool
    {
        return $authUser->can('Restore:G002M008StockBalance');
    }

    public function forceDelete(AuthUser $authUser, G002M008StockBalance $g002M008StockBalance): bool
    {
        return $authUser->can('ForceDelete:G002M008StockBalance');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G002M008StockBalance');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G002M008StockBalance');
    }

    public function replicate(AuthUser $authUser, G002M008StockBalance $g002M008StockBalance): bool
    {
        return $authUser->can('Replicate:G002M008StockBalance');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G002M008StockBalance');
    }

}