<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select post_id, sum(liked) likes, sum(!liked) dislikes from likes group by post_id',
            'likes',
            'likes.post_id',
            'posts.id'
        );
    }

    public function isLikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('post_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('post_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate(
            [
                'user_id' => $user ? $user->id : auth()->id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }

    public function likes()
    {
        return $this->hasMany(Like::class)->where('liked', true);
    }

    public function dislikes()
    {
        return $this->hasMany(Like::class)->where('liked', false);
    }
}
