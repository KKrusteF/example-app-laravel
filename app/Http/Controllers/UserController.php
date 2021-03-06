<?php

namespace App\Http\Controllers;


use App\Http\Requests\ValidateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function index(User $user)
    {
        if (auth()->id() !== $user->id) {
            abort(403, 'You do not have access to this page.');
        }

        return view('sessions.edit', ['user' => $user]);
    }

    public function update(User $user, ValidateUserRequest $request)
    {
        $validated = $request->validated();

        if (!Hash::check($validated['current_password'], $user->password) && !$validated['current_password'] == null) {
            return back()
                ->withInput()
                ->withErrors(['current_password' => 'Your provided credentials could not be verified.']);
        }

        $validated = $request->safe()->except(['current_password', 'password_confirmation']);

        if ($validated['avatar'] ?? false) {
            $this->deleteAvatar($user);
            $validated['avatar'] = request()->file('avatar')->store('avatar');
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated!');
    }

    private function deleteAvatar($user)
    {
        $path = public_path('storage/' . $user->avatar);
        File::delete($path);
    }
}
