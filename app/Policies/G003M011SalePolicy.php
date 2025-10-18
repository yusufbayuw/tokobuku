<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\G003M011Sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class G003M011SalePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:G003M011Sale');
    }

    public function view(AuthUser $authUser, G003M011Sale $g003M011Sale): bool
    {
        return $authUser->can('View:G003M011Sale');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:G003M011Sale');
    }

    public function update(AuthUser $authUser, G003M011Sale $g003M011Sale): bool
    {
        return $authUser->can('Update:G003M011Sale');
    }

    public function delete(AuthUser $authUser, G003M011Sale $g003M011Sale): bool
    {
        return $authUser->can('Delete:G003M011Sale');
    }

    public function restore(AuthUser $authUser, G003M011Sale $g003M011Sale): bool
    {
        return $authUser->can('Restore:G003M011Sale');
    }

    public function forceDelete(AuthUser $authUser, G003M011Sale $g003M011Sale): bool
    {
        return $authUser->can('ForceDelete:G003M011Sale');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:G003M011Sale');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:G003M011Sale');
    }

    public function replicate(AuthUser $authUser, G003M011Sale $g003M011Sale): bool
    {
        return $authUser->can('Replicate:G003M011Sale');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:G003M011Sale');
    }

}