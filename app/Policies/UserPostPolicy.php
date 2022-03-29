<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Post $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny(
                'You do not own this post.'
            );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Post $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny(
                'You do not own this post.'
            );
    }


//    /**
//     * Determine whether the user can view any models.
//     *
//     * @param \App\Models\User $user
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function viewAny(User $user)
//    {
//        return Auth::user()->id !== $user->id
//            ? Response::allow()
//            : Response::deny(
//                'You do not have access to these posts.'
//            );
//    }
}
