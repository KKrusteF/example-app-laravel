<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{

    public function index(User $user)
    {
        if (auth()->id() !== $user->id) {
            abort(403, 'You do not have access to this page.');
        }

        return view('sessions.edit', ['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $validated = $request->validate([
            'username' => [Rule::unique('users', 'username')->ignore($user)],
//            'password'=> [Password::min(8)->letters()->numbers()],
            'password'=> 'required_if:password,""',
            'avatar' => 'image'
        ]);

        if ($validated['avatar'] ?? false) {
            $path = public_path('storage/'. $user->avatar);
            File::delete($path);
            $validated['avatar'] = request()->file('avatar')->store('avatar');
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated!');
    }
}
