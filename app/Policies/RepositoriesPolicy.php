<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Repositories;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepositoriesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_repositories');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Repositories $repositories): bool
    {
        return $user->can('view_repositories');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_repositories');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Repositories $repositories): bool
    {
        return $user->can('update_repositories');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Repositories $repositories): bool
    {
        return $user->can('delete_repositories');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_repositories');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Repositories $repositories): bool
    {
        return $user->can('force_delete_repositories');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_repositories');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Repositories $repositories): bool
    {
        return $user->can('restore_repositories');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_repositories');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Repositories $repositories): bool
    {
        return $user->can('replicate_repositories');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_repositories');
    }
}
