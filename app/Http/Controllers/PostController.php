<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePostRequest;
use App\Models\Post;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function like(Post $post)
    {
        $post->like(auth()->user());

        return back()->with('success', 'Post liked!');
    }

    public function dislike(Post $post)
    {
        $post->like(auth()->user(), false);

        return back()->with('success', 'Post disliked!');
    }
}
