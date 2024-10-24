<?php

namespace App\Policies;

use App\Models\Chapter;
use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\Response;

class VideoPolicy
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
    public function view(User $user, Video $video): bool
    {
        // 用户购买项目时才可以查看视频
        // dd($video->chapter->toArray());
        // $user->chapters 是一个集合\
        // 用户所购买的章节是否含有当前视频所在的章节
        return  isAdministrator() || $user->chapters->contains($video->chapter);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return  isAdministrator();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        //
        return  isAdministrator();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Video $video): bool
    {
        //
        return  isAdministrator();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Video $video): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Video $video): bool
    {
        //
    }
}
