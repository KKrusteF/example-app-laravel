<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('crud.index', [
            'posts' => Post::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('crud.create');
    }

    public function store(ValidatePostRequest $request)
    {
        $validated = $request->validated();

        Post::create(array_merge($validated, [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('crud.edit', ['post' => $post]);
    }

    public function update(Post $post, ValidatePostRequest $request)
    {
        $validated = $request->validated();
//        $attributes = $this->validatePost($post);

        if ($validated['thumbnail'] ?? false) {
            $this->deleteThumbnail($post);
            $validated['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($validated);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $this->deleteThumbnail($post);

        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    public function deleteThumbnail(Post $post)
    {
        $path = public_path('storage/'. $post->thumbnail);
        File::delete($path);
    }
}
