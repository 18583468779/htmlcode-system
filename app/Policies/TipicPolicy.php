<?php

namespace App\Policies;

use App\Models\Tipic;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TipicPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        // 第一个调用的方法，用来放行超级管理员的操作
        if ($user->isAdministrator) {
            return true;
        }
        return null;
    }
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
    public function view(User $user, Tipic $tipic): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //

        return !$user->is_lock; // 被锁定用户无法发表帖子
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tipic $tipic): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tipic $tipic): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tipic $tipic): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tipic $tipic): bool
    {
        //
    }
}
