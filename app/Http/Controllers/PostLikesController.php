<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikesController extends Controller
{
    public function store(Post $post)
    {
        $post->like(auth()->user());

        return back()->with('success', 'Post liked!');
    }

    public function destroy(Post $post)
    {
        $post->like(auth()->user());

        return back()->with('success', 'Post disliked!');
    }
}
