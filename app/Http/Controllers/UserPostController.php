<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            abort(403, 'You do not have access to these posts.');
        }

        return view('crud.index', [
            'posts' => Post::where('user_id', $user->id)->paginate(10),
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

    public function edit(Post $post, User $user)
    {
        $this->authorize('update', $post);

        return view('crud.edit', ['post' => $post]);
    }

    public function update(Post $post, ValidatePostRequest $request)
    {
        $this->authorize('update', $post);

        $validated = $request->validated();


        if ($validated['thumbnail'] ?? false) {
            $this->deleteThumbnail($post);
            $validated['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($validated);

        return back()->with('success', 'Your post has been updated!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('forceDelete', $post);
        $this->deleteThumbnail($post);

        $post->delete();

        return back()->with('success', 'Your post has been deleted!');
    }

    public function deleteThumbnail(Post $post)
    {
        $path = public_path('storage/'. $post->thumbnail);
        File::delete($path);
    }
}
