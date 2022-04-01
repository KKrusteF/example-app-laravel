<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function isLikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('post_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('post_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like($user, $liked = true)
    {
        return $this->likes()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'liked' => $liked,
            ]
        );
    }

    public function dislikesCount()
    {
        return $this->likes()
            ->where('liked', false)
            ->count();
    }

    public function likesCount()
    {
        return $this->likes()
            ->where('liked', true)
            ->count();
    }
}
