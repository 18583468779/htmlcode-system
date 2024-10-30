<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Package;
use Illuminate\Auth\Access\Response;

class PackagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, package $package): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return isAdministrator();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, package $package): bool
    {
        //
        return isAdministrator();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, package $package): bool
    {
        //
        return isAdministrator();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, package $package): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, package $package): bool
    {
        //
    }
}